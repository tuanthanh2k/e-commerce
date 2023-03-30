<?php

use App\Models\Cart;
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
        if (!Schema::hasColumn('cart_products', 'cart_id'))
            Schema::table('cart_products', function (Blueprint $table) {
                $table->foreignIdFor(Cart::class, 'cart_id')->constrained()->onDelete('cascade');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasColumn('cart_products', 'cart_id'))
            Schema::table('cart_products', function (Blueprint $table) {
                $table->foreignIdFor(Cart::class, 'cart_id')->constrained()->onDelete('cascade');
            });
    }
};
