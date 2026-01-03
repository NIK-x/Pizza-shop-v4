<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('cities')) {
            Schema::create('cities', function (Blueprint $table) {
                $table->id('city_id');
                $table->string('city_name', 225);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};