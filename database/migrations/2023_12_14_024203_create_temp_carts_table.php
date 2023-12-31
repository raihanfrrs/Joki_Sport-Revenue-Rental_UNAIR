<?php

use App\Models\Field;
use App\Models\DetailField;
use App\Models\Gor;
use App\Models\Renter;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('temp_carts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Renter::class);
            $table->foreignIdFor(Gor::class);
            $table->foreignIdFor(Field::class);
            $table->foreignIdFor(DetailField::class);
            $table->string('day_name');
            $table->date('date');
            $table->dateTime('due');
            $table->string('subtotal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temp_carts');
    }
};
