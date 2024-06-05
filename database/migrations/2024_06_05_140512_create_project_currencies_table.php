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
        Schema::create('project_currencies', function (Blueprint $table) {
            $table->id();
            $table->string('code_alfa', '3')->index();
            $table->string('code_num', '3')->index();
            $table->float('rate_buy')->nullable();
            $table->float('rate_sell')->nullable();
            $table->float('rate_cross')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_currencies');
    }
};
