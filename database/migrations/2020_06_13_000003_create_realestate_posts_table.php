<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRealestatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('real_estate_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('real_estate_for')->nullable(true);
            $table->tinyInteger('condition');
            $table->string('location_country');
            $table->string('location_state');
            $table->string('location_city');
            $table->string('location_address_line_1');
            $table->string('location_address_line_2');
            $table->string('location_coordinates');
            $table->string('short_description');
            $table->string('detail_description');
            $table->smallInteger('number_of_bedrooms');
            $table->smallInteger('number_of_bathrooms');
            $table->float('size');
            $table->float('age');
            $table->float('rent');
            $table->float('min_lease_term');
            $table->integer('advanced_payment_unit');
            $table->integer('advanced_payment');
            $table->tinyInteger('utility_bill_payments_included');
            $table->tinyInteger('negotiable');
            $table->smallInteger('number_of_parking_slots');


            $table->unsignedBigInteger('property_category')->nullable(true);
            $table->unsignedBigInteger('property_sub_category')->nullable(true);
            $table->unsignedBigInteger('contact_id')->nullable(true);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('real_estate_for')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('property_category')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('property_sub_category')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('contact_id')->references('id')->on('contacts')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('real_estate_posts');
    }
}