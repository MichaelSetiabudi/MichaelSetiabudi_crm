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
        Schema::table('projects', function (Blueprint $table) {
            // Add rejection fields
            $table->foreignId('rejected_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('rejected_at')->nullable();
            $table->text('rejection_reason')->nullable();
            
            // Add description field
            $table->text('description')->nullable();
            
            // Add expected close date
            $table->date('expected_close_date')->nullable();
            
            // Make some fields nullable for flexibility
            $table->foreignId('product_id')->nullable()->change();
            $table->foreignId('lead_id')->nullable()->change();
            
            // Add customer_id field
            $table->foreignId('customer_id')->nullable()->constrained()->onDelete('cascade');
            
            // Rename sales_id to assigned_sales_id for clarity
            $table->renameColumn('sales_id', 'assigned_sales_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            // Remove rejection fields
            $table->dropForeign(['rejected_by']);
            $table->dropColumn(['rejected_by', 'rejected_at', 'rejection_reason']);
            
            // Remove added fields
            $table->dropColumn(['description', 'expected_close_date']);
            
            // Remove customer_id
            $table->dropForeign(['customer_id']);
            $table->dropColumn('customer_id');
            
            // Rename back
            $table->renameColumn('assigned_sales_id', 'sales_id');
        });
    }
};
