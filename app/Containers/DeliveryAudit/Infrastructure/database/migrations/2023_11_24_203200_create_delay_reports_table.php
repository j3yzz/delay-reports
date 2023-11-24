<?php

use App\Containers\DeliveryAudit\Models\DelayReport;
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
        Schema::create('delay_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->enum('approach_type', DelayReport::APPROACH_TYPES);
            $table->enum('status', DelayReport::STATUSES);
            $table->foreignId('agent_id')->nullable()->constrained()->cascadeOnDelete();
            $table->longText('agent_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delay_reports');
    }
};
