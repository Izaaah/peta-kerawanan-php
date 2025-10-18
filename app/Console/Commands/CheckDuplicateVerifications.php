<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\DataVerification;

class CheckDuplicateVerifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'verification:check-duplicates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and clean up duplicate verification records';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking for duplicate verification records...');

        // Find duplicate verification records
        $duplicates = DataVerification::select('table_name', 'data_id', 'admin_id')
            ->where('status', 'pending')
            ->groupBy('table_name', 'data_id', 'admin_id')
            ->havingRaw('COUNT(*) > 1')
            ->get();

        if ($duplicates->count() > 0) {
            $this->warn("Found {$duplicates->count()} duplicate groups:");

            foreach ($duplicates as $duplicate) {
                $this->line("Table: {$duplicate->table_name}, Data ID: {$duplicate->data_id}, Admin ID: {$duplicate->admin_id}");

                // Get all verifications for this group
                $verifications = DataVerification::where('table_name', $duplicate->table_name)
                    ->where('data_id', $duplicate->data_id)
                    ->where('admin_id', $duplicate->admin_id)
                    ->where('status', 'pending')
                    ->orderBy('created_at', 'desc')
                    ->get();

                $this->line("  Found {$verifications->count()} verifications:");
                foreach ($verifications as $verification) {
                    $this->line("    ID: {$verification->id}, Created: {$verification->created_at}");
                }

                // Keep the latest, delete the rest
                if ($verifications->count() > 1) {
                    $toDelete = $verifications->skip(1);
                    $this->line("  Deleting " . $toDelete->count() . " duplicate verifications...");

                    foreach ($toDelete as $verification) {
                        $verification->delete();
                        $this->line("    Deleted verification ID: {$verification->id}");
                    }
                }
            }

            $this->info('✅ Duplicate verification records cleaned up!');
        } else {
            $this->info('✅ No duplicate verification records found.');
        }

        return Command::SUCCESS;
    }
}
