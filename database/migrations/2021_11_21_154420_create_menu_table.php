<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->integer('status_stock');
            $table->string('status', 15);
            $table->integer('price');
            $table->text('image');
            $table->string('reason', 100)->nullable();
            $table->string('created_by', 50);
            $table->string('updated_by', 50)->nullable();
            $table->string('approved_by', 50)->nullable();
            $table->date('approved_at')->nullable();
            $table->integer('category_id');
            $table->text('description');
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
        Schema::dropIfExists('menu');
    }
}
