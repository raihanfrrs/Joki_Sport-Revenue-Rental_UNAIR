<?php

use App\Models\Owner;
use App\Models\Subscription;
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
        Schema::create('owner_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Subscription::class);
            $table->foreignIdFor(Owner::class);
            $table->date('until')->nullable();
            $table->enum('status', ['active', 'expired'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('owner_subscriptions');
    }
};
