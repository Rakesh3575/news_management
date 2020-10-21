<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCategoryIdToNews extends Migration
{ 
    public function up()
    {
        Schema::table('news', function (Blueprint $table) {
           $table->integer('category_id')->unsigned()->nullable()->after('user_id');
           $table->foreign('category_id')->references('id')->on('categories');
        });
    } 
    public function down()
    {
            Schema::table('news', function (Blueprint $table){
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
}
