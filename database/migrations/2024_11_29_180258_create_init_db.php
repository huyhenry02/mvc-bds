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
        Schema::create('investors', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('phone_number')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->timestamps();
        });

        Schema::create('districts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->foreignId('city_id')->constrained('cities')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->string('name');
            $table->text('description')->nullable();
            $table->foreignId('city_id')->constrained('cities')->onDelete('cascade');
            $table->foreignId('district_id')->constrained('districts')->onDelete('cascade');
            $table->string('specific_address')->nullable();
            $table->string('account_holder')->nullable();
            $table->string('account_number')->nullable();
            $table->string('bank')->nullable();
            $table->foreignId('investor_id')->constrained('investors')->onDelete('cascade');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->enum('status', ['on_sale', 'completed', 'upcoming']);
            $table->string('qr_code')->nullable();
            $table->string('image_project')->nullable();
            $table->timestamps();
        });

        Schema::create('zones', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('plots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('zone_id')->constrained('zones')->onDelete('cascade');
            $table->string('name');
            $table->float('size');
            $table->integer('price');
            $table->integer('deposit');
            $table->string('specific_address')->nullable();
            $table->enum('status', ['empty', 'deposited', 'sold']);
            $table->text('description')->nullable();
            $table->string('main_image')->nullable();
            $table->string('sub_image_1')->nullable();
            $table->string('sub_image_2')->nullable();
            $table->string('sub_image_3')->nullable();
            $table->string('sub_image_4')->nullable();
            $table->timestamps();
        });

        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('plot_id')->constrained('plots')->onDelete('cascade');
            $table->dateTime('transaction_date');
            $table->enum('status', ['pending', 'success', 'reject']);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('plots');
        Schema::dropIfExists('zones');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('districts');
        Schema::dropIfExists('cities');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('investors');
    }
};
