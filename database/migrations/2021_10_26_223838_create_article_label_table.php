<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleLabelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_label', function (Blueprint $table) {
            $table->id();
            $table->foreignId('article_id')->constrained();
            $table->foreignId('label_id')->constrained();
            $table->timestamps();

            $table->unique(['article_id', 'label_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_label');
    }
}
