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
            $table->text('extra_fields')->after('number_of_parking_slots');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('real_estate_posts', function (Blueprint $table) {
            $table->dropColumn('extra_fields');
        });
    }
}
