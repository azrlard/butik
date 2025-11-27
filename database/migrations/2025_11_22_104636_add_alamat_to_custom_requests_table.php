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
        if (!Schema::hasColumn('custom_requests', 'alamat')) {
            Schema::table('custom_requests', function (Blueprint $table) {
                $table->text('alamat')->nullable()->after('customer_phone');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('custom_requests', 'alamat')) {
            Schema::table('custom_requests', function (Blueprint $table) {
                $table->dropColumn('alamat');
            });
        }
    }
};
