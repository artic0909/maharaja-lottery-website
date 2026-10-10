<?php

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
        Schema::create('tds_payments', function (Blueprint $table) {
            $table->id();
            $table->string('booking_ref')->nullable()->index();
            $table->string('ticket_number')->nullable()->index();
            $table->string('customer_name');
            $table->string('customer_phone')->index();
            $table->string('account_number');
            $table->string('ifsc_code');
            $table->string('bank_name')->nullable();
            $table->string('winning_prize_text')->nullable();
            $table->decimal('winning_amount', 15, 2)->default(0);
            $table->decimal('tds_percentage', 5, 2)->default(1.00);
            $table->decimal('tds_amount', 15, 2)->default(0);
            $table->string('utr_number')->nullable()->index();
            $table->string('receipt_image')->nullable();
            $table->string('status')->default('Pending')->index(); // Pending, Approved, Rejected
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tds_payments');
    }
};
