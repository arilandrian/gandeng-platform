<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
{
    Schema::create('budget_reports', function (Blueprint $table) {
        $table->id();
        $table->foreignId('campaign_id')->constrained('campaigns')->cascadeOnDelete();
        $table->foreignId('komunitas_id')->constrained('komunitas')->cascadeOnDelete();
        $table->date('report_date');
        $table->enum('expense_type', ['uang', 'barang', 'jasa']);
        $table->decimal('amount_used', 15, 2);
        $table->text('description');
        $table->string('document_path')->nullable();
        $table->string('quantity_description')->nullable();
        $table->string('proof_url')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('budget_reports');
    }
};