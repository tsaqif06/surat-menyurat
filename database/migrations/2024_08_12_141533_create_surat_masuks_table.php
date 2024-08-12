<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_masuks', function (Blueprint $table) {
            $table->increments('id_surat_masuk');
            $table->integer('id_relasi');
            $table->integer('id_bagian');
            $table->integer('id_ruang_penyimpanan');
            $table->integer('id_jenis_surat_masuk');
            $table->string('judul_surat_masuk', 50);
            $table->string('nomor_surat_masuk', 50);
            $table->string('lampiran', 10);
            $table->string('perihal', 100);
            $table->text('keterangan');
            $table->date('tanggal_surat_masuk');
            $table->string('file_surat', 500);
            $table->integer('status_surat');
            $table->dateTime('tanggal_update');
            $table->string('update_by', 50);
            $table->date('tanggal_disposisi');
            $table->string('tindaklanjut_disposisi', 100);
            $table->text('ket_disposisi');
            $table->string('nama_ruang', 100);
            $table->string('no_almari', 20);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surat_masuks');
    }
};
