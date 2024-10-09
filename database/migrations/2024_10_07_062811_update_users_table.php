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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('email');
            $table->dropColumn('email_verified_at');
            $table->string('password')->nullable()->change();
            $table->string('surname')->after('name')->nullable();
            $table->string('phone')->after('surname')->nullable();
            $table->boolean('is_admin')->after('phone')->default(false);
            $table->string('telegram_chat_id')->after('is_admin')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
