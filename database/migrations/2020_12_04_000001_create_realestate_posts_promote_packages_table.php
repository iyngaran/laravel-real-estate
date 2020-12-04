<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRealestatePostsPromotePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('real_estate_post_promote_package', function (Blueprint $table) {
            $table->primary(['real_estate_post_id','promote_package_id'],'post_promotion_id');
            $table->unsignedBigInteger('real_estate_post_id');
            $table->unsignedBigInteger('promote_package_id');
            $table->timestamps();
            $table->foreign('real_estate_post_id')->references('id')->on('real_estate_posts');
            $table->foreign('promote_package_id')->references('id')->on('promote_packages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('real_estate_post_promote_package');
    }
}
