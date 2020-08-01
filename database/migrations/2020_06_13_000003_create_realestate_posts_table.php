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
            $table->string('real_estate_for', 20)->nullable(true);
            $table->tinyInteger('condition');
            $table->string('location_country',3)->nullable(true);
            $table->string('location_state',55)->nullable(true);
            $table->string('location_city', 55)->nullable(true);
            $table->string('location_address_line_1');
            $table->string('location_address_line_2')->nullable(true);
            $table->json('location_coordinates');
            $table->string('short_description')->nullable(true);
            $table->text('detail_description')->nullable(true);
            $table->smallInteger('number_of_bedrooms')->nullable(true);
            $table->smallInteger('number_of_bathrooms')->nullable(true);
            $table->float('size')->nullable(true);
            $table->string('size_unit', 20)->nullable(true);
            $table->float('age')->nullable(true);
            $table->string('age_unit',20)->nullable(true);
            $table->double('price')->nullable(true);
            $table->string('price_unit',10)->nullable(true);
            $table->float('min_lease_term')->nullable(true);
            $table->string('min_lease_term_unit',10)->nullable(true);
            $table->float('advanced_payment')->nullable(true);
            $table->string('advanced_payment_unit',3)->nullable(true);
            $table->string('utility_bill_payments_included',3)->default('No');
            $table->string('negotiable', 3)->default('No');
            $table->smallInteger('number_of_parking_slots')->nullable(true);


            $table->unsignedBigInteger('property_category')->nullable(true);
            $table->unsignedBigInteger('property_sub_category')->nullable(true);
            $table->unsignedBigInteger('contact_id')->nullable(true);
            $table->enum('status',['Published','Drafted','Pending']);
            $table->softDeletes();
            $table->timestamps();

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