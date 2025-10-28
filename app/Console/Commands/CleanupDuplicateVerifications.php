<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\DuplicateDetectionService;

class CleanupDuplicateVerifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'verification:cleanup-duplicates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean up duplicate verification records';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting cleanup of duplicate verification records...');

        $result = DuplicateDetectionService::cleanupDuplicateVerifications();

        if ($result) {
            $this->info('✅ Duplicate verification records cleaned up successfully!');
        } else {
            $this->error('❌ Failed to cleanup duplicate verification records.');
        }

        return Command::SUCCESS;
    }
}
