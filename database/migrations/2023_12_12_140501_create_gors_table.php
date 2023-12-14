<?php

use App\Models\Owner;
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
        Schema::create('gors', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Owner::class);
            $table->string('name');
            $table->bigInteger('price');
            $table->enum('type_duration', ['jam', 'masuk']);
            $table->text('address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gors');
    }
};
