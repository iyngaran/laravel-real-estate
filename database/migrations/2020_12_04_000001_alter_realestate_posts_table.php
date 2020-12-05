<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterRealestatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('real_estate_posts', function (Blueprint $table) {
            $table->json('extra_fields')->nullable()->default(null)->after('number_of_parking_slots');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('real_estate_posts', function (Blueprint $table) {
            $table->dropColumn('extra_fields');
        });
    }
}
