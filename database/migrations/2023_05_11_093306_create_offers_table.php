<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('offers', static function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->unsignedDecimal('min_investment', 16);
            $table->unsignedDecimal('max_investment', 16)->nullable();
            $table->unsignedDecimal('min_interest', 16);
            $table->unsignedDecimal('max_interest', 16)->nullable();
            $table->unsignedInteger('duration_in_seconds');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
