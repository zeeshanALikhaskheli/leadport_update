<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateLogisticsDataTable extends Migration
{
    public function up()
    {
        Schema::create('logistics_data', function (Blueprint $table) {
            $table->id();

            // General fields
            $table->string('request_type')->nullable();
            $table->integer('quantity')->nullable();
            $table->date('shipping_date')->nullable();
            $table->time('shipping_time')->nullable();

            // Shipper details
            $table->string('shipper_name')->nullable();
            $table->string('shipper_country')->nullable();
            $table->string('shipper_city')->nullable();
            $table->string('shipper_address')->nullable();
            $table->text('pickup_remarks')->nullable();

            // Shipping details
            $table->string('shipping_carrier')->nullable();
            $table->string('transport_mode')->nullable();
            $table->string('container_type')->nullable();
            $table->float('cargo_weight_kg')->nullable();
            $table->string('cargo_type')->nullable();
            $table->string('origin')->nullable();
            $table->string('destination')->nullable();

            // Delivery details
            $table->date('delivery_date')->nullable();
            $table->time('delivery_time')->nullable();
            $table->string('consignee_name')->nullable();
            $table->string('consignee_country')->nullable();
            $table->string('consignee_city')->nullable();
            $table->string('consignee_address')->nullable();
            $table->text('delivery_remarks')->nullable();
            $table->string('carrier_for_delivery')->nullable();

            // Special requirements
            $table->boolean('temperature_sensitive')->nullable();
            $table->string('temperature_range')->nullable();
            $table->string('adr')->nullable();
            $table->string('un_code')->nullable();
            $table->boolean('fragile')->nullable();
            $table->text('notes')->nullable();

            // Additional information
            $table->float('chargeable_weight')->nullable();
            $table->unsignedBigInteger('ticket_user_id')->nullable();

            $table->timestamps(); // created_at and updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('logistics_data');
    }
}
