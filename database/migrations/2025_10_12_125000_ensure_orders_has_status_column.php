<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('orders', 'status')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->string('status')->default('pending')->after('total_price');
            });
        }

        if (!Schema::hasColumn('orders', 'tracking_number')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->string('tracking_number')->nullable()->after('status');
            });
        }
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['status', 'tracking_number']);
        });
    }
};