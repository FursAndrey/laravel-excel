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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            $table->foreignId('type_id')->index()->constrained('types');
            $table->string('title');
            $table->date('date_created');
            $table->boolean('setevik')->nullable();
            $table->smallInteger('member_count', false, true)->nullable();
            $table->boolean('has_outsource')->nullable();
            $table->boolean('has_investors')->nullable();
            $table->date('date_deadline')->nullable();
            $table->boolean('on_time')->nullable();
            $table->integer('step_1', unsigned:true)->nullable();
            $table->integer('step_2', unsigned:true)->nullable();
            $table->integer('step_3', unsigned:true)->nullable();
            $table->integer('step_4', unsigned:true)->nullable();
            $table->date('date_signed')->nullable();
            $table->smallInteger('service_count', false, true)->nullable();
            $table->text('comment')->nullable();
            $table->decimal('effectiveness', total:8, places:2)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
