<?php

namespace App\Models;

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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
	    $table->foreignIdFor(User::class, 'user_id')->cascadeOnDelete();
	    $table->foreignIdFor(Category::class, 'category_id')->nullOnDelete();
	    $table->string('transaction_type');
	    $table->float('amount', precision: 2);
            $table->timestamps();

	    $table->unique(['user_id', 'category_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
