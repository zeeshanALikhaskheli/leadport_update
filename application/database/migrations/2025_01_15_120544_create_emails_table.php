<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('emails', function (Blueprint $table) {
            $table->id();
            $table->string('uid')->unique();
            $table->string('subject');
            $table->string('from');
            $table->text('body');
            $table->json('logistics_data');
            $table->timestamp('received_at');
            $table->timestamps();

            // logisticsdata 
            $table->string('request_type')->nullable();
            $table->integer('quantity')->nullable();
            $table->date('shipping_date')->nullable();
            $table->time('shipping_time')->nullable();
            $table->string('shipper_name')->nullable();
            $table->string('shipper_country')->nullable();
            $table->string('shipper_city')->nullable();
            $table->text('shipper_address')->nullable();
            $table->text('pickup_remarks')->nullable();
            $table->string('shipping_carrier')->nullable();
            $table->string('transport_mode')->nullable();
            $table->string('container_type')->nullable();
            $table->float('cargo_weight_kg')->nullable();
            $table->string('cargo_type')->nullable();
            $table->string('origin')->nullable();
            $table->string('destination')->nullable();
            $table->date('delivery_date')->nullable();
            $table->time('delivery_time')->nullable();
            $table->string('consignee_name')->nullable();
            $table->string('consignee_country')->nullable();
            $table->string('consignee_city')->nullable();
            $table->text('consignee_address')->nullable();
            $table->text('delivery_remarks')->nullable();
            $table->string('carrier_for_delivery')->nullable();
            $table->boolean('temperature_sensitive')->nullable();
            $table->string('temperature_range')->nullable();
            $table->string('adr')->nullable();
            $table->string('un_code')->nullable();
            $table->boolean('fragile')->nullable();
            $table->text('notes')->nullable();
            $table->float('chargeable_weight')->nullable();
            $table->unsignedBigInteger('ticket_user_id')->nullable();
            


        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emails');
    }
};
