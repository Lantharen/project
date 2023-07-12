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
        Schema::table('offers', static function (Blueprint $table): void {
            $table->unsignedMediumInteger('position')
                ->default(0)
                ->after('duration_in_seconds');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('offers', static function (Blueprint $table): void {
            $table->dropColumn('position');
        });
    }
};
