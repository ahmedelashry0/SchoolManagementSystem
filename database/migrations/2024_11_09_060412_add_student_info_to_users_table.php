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
            $table->after('user_type', function ($table) {
                $table->string('admission_number')->nullable();
                $table->date('admission_date')->nullable();
                $table->string('roll_number')->nullable();
                $table->foreignId('class_id')->nullable()->constrained('classrooms')->nullOnDelete()->cascadeOnUpdate();
                $table->enum('gender',['male','female'])->default('male');
                $table->enum('status',['active','inactive'])->default('inactive');
                $table->string('religion')->nullable();
                $table->date('date_of_birth')->nullable();
                $table->string('phone_number')->nullable();
                $table->string('image')->nullable();
                $table->string('blood_group')->nullable();
                $table->string('occupation')->nullable();
                $table->string('address')->nullable();
                $table->integer('height')->nullable();
                $table->integer('weight')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'admission_number',
                'admission_date',
                'roll_number',
                'class_id',
                'gender',
                'status',
                'religion',
                'date_of_birth',
                'phone_number',
                'image',
                'blood_group',
                'occupation',
                'address',
                'height',
                'weight'
            ]);
        });
    }

};
