<?php

use App\Models\DetailField;
use App\Models\Field;
use App\Models\Renter;
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
        Schema::create('temp_dates', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Renter::class);
            $table->foreignIdFor(Field::class);
            $table->foreignIdFor(DetailField::class);
            $table->string('day_name');
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temp_dates');
    }
};
