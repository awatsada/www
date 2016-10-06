<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // foreign key type must be the same type+length of its reference
        // pivot table must be created after original table (comments and tags)
        Schema::create('comment_tag', function (Blueprint $table) {
            $table->integer('comment_id')->unsigned()->index(); // add index to make searching faster
            // if id@comments table is deleted, comment_id@pivot will be following deleted            
            $table->foreign('comment_id')->references('id')->on('comments')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('tag_id')->unsigned()->index();
            // if id@tags table is deleted, tag_id@pivot will be following deleted            
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('comment_tag');
    }
}
