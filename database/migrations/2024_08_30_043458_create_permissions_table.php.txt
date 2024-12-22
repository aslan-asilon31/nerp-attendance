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
    Schema::create('permissions', function (Blueprint $table) {
      $table->string('id', 64)->primary();
      $table->string('page_id', 64);
      $table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade')->onUpdate('cascade');
      $table->string('action_id', 64);
      $table->foreign('action_id')->references('id')->on('actions')->onDelete('cascade')->onUpdate('cascade');

      $table->string('name', 255);
      $table->string('created_by', 255)->nullable()->index();
      $table->string('updated_by', 255)->nullable()->index();
      $table->timestamps();
      $table->boolean('is_activated')->default(true);
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('permissions');
  }
};
