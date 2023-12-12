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
        Schema::create('izins', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->date('tgl_izin')->nullable();
            $table->char('status', 1)->nullable()->comment('status: i=Izin, s=Sakit');
            $table->string('keterangan')->nullable();
            $table->char('status_approved', 1)->default(0)->nullable()->comment('status_approved: 0=Pending, 1=Disetujui, 2=Ditolak');
            $table->timestamps();

            // relationship users
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('izins');
    }
};
