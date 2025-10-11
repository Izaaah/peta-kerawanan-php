<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Menambahkan kolom created_by ke tabel tkp_residivis_individu jika tabel sudah ada
        if (Schema::hasTable('tkp_residivis_individu')) {
            Schema::table('tkp_residivis_individu', function (Blueprint $table) {
                // Hanya tambahkan kolom created_by jika belum ada
                if (!Schema::hasColumn('tkp_residivis_individu', 'created_by')) {
                    $table->unsignedBigInteger('created_by')->nullable()->after('lokasi');
                    $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
                }
            });
        }

        // Mengubah tabel data_individu_tsk untuk memindahkan beberapa kolom ke status
        Schema::table('data_individu_tsk', function (Blueprint $table) {
            // Cek apakah kolom-kolom ini ada, dan jika ada, hapus
            if (Schema::hasColumn('data_individu_tsk', 'modus_operasi')) {
                $table->dropColumn('modus_operasi');
            }

            if (Schema::hasColumn('data_individu_tsk', 'jenis_narkotika')) {
                $table->dropColumn('jenis_narkotika');
            }

            if (Schema::hasColumn('data_individu_tsk', 'skala_kelas')) {
                $table->dropColumn('skala_kelas');
            }

            // Menambahkan kolom status sebagai varchar (string) hanya jika kolom status belum ada
            if (!Schema::hasColumn('data_individu_tsk', 'status')) {
                $table->string('status', 50)->nullable(); // Kolom status umum (Compulsory, Proses Hukum Lanjutan, Narapidana)
            }
        });

        // Menambah tabel status_hukum untuk status lebih lanjut (Compulsory, Proses Hukum Lanjutan, Narapidana)
        if (!Schema::hasTable('status_hukum')) {
            Schema::create('status_hukum', function (Blueprint $table) {
                $table->id();
                $table->foreignId('individu_id')->constrained('data_individu_tsk')->onDelete('cascade');
                $table->string('status_hukum', 50);  // Contoh status: Compulsory, Proses Hukum Lanjutan, Narapidana
                $table->date('tanggal_kasus')->nullable();
                $table->string('nomor_kasus')->nullable();
                $table->string('satuan_kerja')->nullable();
                $table->string('aph')->nullable(); // APH yang menangani
                $table->string('pasal_disangkakan')->nullable(); // Kolom pasal yang disangkakan
                $table->timestamps();
            });
        }

        // Menambah tabel residivis_detail untuk menyimpan file dokumen, pasal disangkakan, vonis, dan lapas
        if (!Schema::hasTable('residivis_detail')) {
            Schema::create('residivis_detail', function (Blueprint $table) {
                $table->id();
                $table->foreignId('individu_id')->constrained('data_individu_tsk')->onDelete('cascade');
                $table->string('file_dokumen')->nullable();  // Untuk menyimpan file dokumen
                $table->string('pasal_disangkakan')->nullable(); // Kolom pasal yang disangkakan
                $table->string('vonis')->nullable(); // Kolom vonis
                $table->string('lapas_akhir')->nullable(); // Kolom lapas
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Menghapus kolom created_by dari tabel tkp_residivis_individu jika rollback
        if (Schema::hasTable('tkp_residivis_individu')) {
            Schema::table('tkp_residivis_individu', function (Blueprint $table) {
                if (Schema::hasColumn('tkp_residivis_individu', 'created_by')) {
                    $table->dropForeign(['created_by']);
                    $table->dropColumn('created_by');
                }
            });
        }

        // Menghapus tabel status_hukum jika rollback
        Schema::dropIfExists('status_hukum');

        // Menghapus tabel residivis_detail jika rollback
        Schema::dropIfExists('residivis_detail');

        // Membalik perubahan di tabel data_individu_tsk
        Schema::table('data_individu_tsk', function (Blueprint $table) {
            // Menambah kembali kolom yang telah dihapus
            $table->text('modus_operasi')->nullable();
            $table->text('jenis_narkotika')->nullable();
            $table->string('skala_kelas', 50)->nullable();

            // Menghapus kolom status jika rollback
            $table->dropColumn('status');
        });
    }
};
