<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAttributeStatusIntoOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('Gender')->nullable();
            $table->string('Country')->nullable();
            $table->string('Province')->nullable();
            $table->string('District')->nullable();
            $table->string('Address_Detail')->nullable();
            $table->string('time_to_delivery')->nullable();
            $table->string('payment_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('Gender');
            $table->dropColumn('Country');
            $table->dropColumn('Province');
            $table->dropColumn('District');
            $table->dropColumn('Address_Detail');
            $table->dropColumn('time_to_delivery');
            $table->dropColumn('payment_type');
        });
    }
}
