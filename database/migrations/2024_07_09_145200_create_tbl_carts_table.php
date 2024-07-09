<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_carts', function (Blueprint $table) {
            $table->id('cart_id');
            $table->unsignedBigInteger('payment_transaction_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity')->default(0);
            $table->tinyInteger('is_deleted')->default(0);
            $table->timestamps();

            $table->foreign('payment_transaction_id')
                ->references('payment_transaction_id')
                ->on('tbl_payment_transactions')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('product_id')
                ->references('product_id')
                ->on('tbl_products')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('tbl_carts');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
};
