<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterRealestatePostsAddContactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('real_estate_posts', function (Blueprint $table) {
            $table->string('property_phone_number_1')->nullable()->default(null)->after('extra_fields');
            $table->string('property_phone_number_2')->nullable()->default(null)->after('property_phone_number_1');
            $table->string('property_email_address')->nullable()->default(null)->after('property_phone_number_2');
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
            $table->dropColumn('property_phone_number_1');
            $table->dropColumn('property_phone_number_2');
            $table->dropColumn('property_email_address');
        });
    }
}
