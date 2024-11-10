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
            $table->after('weight' , function ($table){
                $table->enum('marital_status', ['married', 'divorced', 'single', 'widow'])->default('single')->nullable();
                $table->string('permanent_address')->nullable();
                $table->string('qualification')->nullable();
                $table->string('work_experience')->nullable;
                $table->string('note')->nulable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('marital_status');
            $table->dropColumn('permanent_address');
            $table->dropColumn('qualification');
            $table->dropColumn('work_experience');
            $table->dropColumn('note');
        });
    }
};
