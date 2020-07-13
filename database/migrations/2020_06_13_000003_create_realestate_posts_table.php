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
            $table->string('location_country')->nullable(true);
            $table->string('location_state')->nullable(true);
            $table->string('location_city')->nullable(true);
            $table->string('location_address_line_1');
            $table->string('location_address_line_2')->nullable(true);
            $table->string('location_coordinates');
            $table->string('short_description')->nullable(true);
            $table->string('detail_description')->nullable(true);
            $table->smallInteger('number_of_bedrooms')->nullable(true);
            $table->smallInteger('number_of_bathrooms')->nullable(true);
            $table->float('size')->nullable(true);
            $table->string('size_unit')->nullable(true);
            $table->float('age')->nullable(true);
            $table->string('age_unit')->nullable(true);
            $table->float('rent')->nullable(true);
            $table->string('rent_unit')->nullable(true);
            $table->float('min_lease_term')->nullable(true);
            $table->string('min_lease_term_unit')->nullable(true);
            $table->integer('advanced_payment')->nullable(true);
            $table->integer('advanced_payment_unit')->nullable(true);
            $table->tinyInteger('utility_bill_payments_included')->nullable(true);
            $table->tinyInteger('negotiable');
            $table->smallInteger('number_of_parking_slots')->nullable(true);


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