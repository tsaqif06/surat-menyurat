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
        Schema::create('rel_disposisis', function (Blueprint $table) {
            $table->integer('id_bagian');
            $table->integer('id_surat_masuk');
            $table->integer('id_surat_keluar');
            $table->integer('status_disposisi', 100);
            $table->primary(['id_bagian', 'id_surat_masuk', 'id_surat_keluar']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rel_disposisis');
    }
};
