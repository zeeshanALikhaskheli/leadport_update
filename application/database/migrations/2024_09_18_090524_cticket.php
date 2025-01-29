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
        Schema::create('ctickets', function (Blueprint $table) {
            $table->id();
        
            // Foreign keys
            $table->foreignId('ticket_status_id')->constrained('ticket_status')->onDelete('cascade');
            $table->foreignId('ticket_type_id')->constrained('ticket_type')->onDelete('cascade');
            $table->foreignId('ticket_order_type_id')->constrained('ticket_order_type')->onDelete('cascade');
            $table->foreignId('ticket_incoterms_id')->constrained('ticket_incoterms')->onDelete('cascade');
            $table->foreignId('ticket_loadtype_id')->constrained('ticket_loadtype')->onDelete('cascade');
        
            // Shipping information
            $table->string('quantity');
            $table->string('shipping_date');
            $table->string('shipping_time');
            $table->string('shipper_name');
            $table->foreignId('shipping_country_id')->constrained('countries')->onDelete('cascade');
            $table->string('shipping_city');
            $table->string('shipping_index');
            $table->string('shipping_address');
            $table->json('shipping_pickup_landmark')->nullable();
            $table->enum('def_shipping', ['0', '1'])->default('0');
            $table->string('def_shipper_name');
            $table->foreignId('def_shipping_country_id')->constrained('countries')->onDelete('cascade');
            $table->string('def_shipping_city');
            $table->string('def_shipping_index');
            $table->string('def_shipping_address');
        
            // Delivery information
            $table->string('delivery_date');
            $table->string('delivery_time');
            $table->string('consigner_name');
            $table->foreignId('delivery_country_id')->constrained('countries')->onDelete('cascade');
            $table->string('delivery_city');
            $table->string('delivery_index');
            $table->string('delivery_address');
            $table->json('delivery_pickup_landmark')->nullable();
            $table->enum('def_delivery', ['0', '1'])->default('0');
            $table->string('def_delivery_name');
            $table->foreignId('def_delivery_country_id')->constrained('countries')->onDelete('cascade');
            $table->string('def_delivery_city');
            $table->string('def_delivery_index');
            $table->string('def_delivery_address');
        
            // Additional fields
            $table->string('temp_sensitive');
            $table->string('temp_range');
            $table->string('adr'); // Dangerous goods code (ADR)
            $table->string('un_code');
            $table->string('fragile');
            $table->text('notes')->nullable();
            $table->text('assigned')->nullable();
        
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ctickets');
    }
};
