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
        Schema::create('tbl_payment_transactions', function (Blueprint $table) {
            $table->id('payment_transaction_id');
            $table->string('transaction_no', 55);
            $table->double('total_price')->default(0);
            $table->double('amount')->default(0);
            $table->unsignedBigInteger('discount_id')->nullable();
            $table->double('change')->default(0);
            $table->tinyInteger('is_deleted')->default(0);
            $table->timestamps();

            $table->foreign('discount_id')
                ->references('discount_id')
                ->on('tbl_discounts')
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
        Schema::dropIfExists('tbl_payment_transactions');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
};
