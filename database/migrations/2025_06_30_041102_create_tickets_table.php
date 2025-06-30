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
        Schema::create('tickets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('email');
            $table->string('title');
            $table->text('description')->nullable();
            $table->uuid('ticket_type_id');
            $table->uuid('project_id');
            $table->date('assign_at');
            $table->enum('status', ['open', 'progress', 'closed', 'cancel'])->default('open');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('ticket_type_id')->references('id')->on('ticket_types');
            $table->foreign('project_id')->references('id')->on('projects');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
