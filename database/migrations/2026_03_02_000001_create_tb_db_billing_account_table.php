<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('tb_db_billing_account')) {
            return;
        }

        Schema::create('tb_db_billing_account', function (Blueprint $table) {
            $table->id();
            $table->string('ip', 50)->nullable();
            $table->string('nama_db', 50)->nullable();
            $table->string('username', 50)->nullable();
            $table->string('password', 50)->nullable();
            $table->string('account', 6)->nullable()->unique();
            $table->string('nama_server', 50)->nullable();
            $table->string('file', 50)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_db_billing_account');
    }
};
