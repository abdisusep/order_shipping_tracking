<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('order_id')->nullable();
            $table->string('tracking_id')->nullable();
            $table->string('waybill_id')->nullable();
            $table->string('shipper_contact_name');
            $table->string('origin_contact_name');
            $table->string('origin_contact_phone');
            $table->text('origin_address');
            $table->string('origin_postal_code');
            $table->string('destination_contact_name');
            $table->string('destination_contact_phone');
            $table->text('destination_address');
            $table->string('destination_postal_code');
            $table->string('courier_company');
            $table->json('items');
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};