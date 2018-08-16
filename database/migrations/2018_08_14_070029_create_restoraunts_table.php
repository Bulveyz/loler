<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestorauntsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('restoraunts', function (Blueprint $table) {
      $table->increments('id');
      $table->string('brand');
      $table->text('description');
      $table->string('email');
      $table->string('phone');
      $table->text('address');
      $table->integer('rate');
      $table->timestamps();
    });
//    $company->each(function($c) {factory('App\Product', rand(10, 50))->create(['restoraunt_id' => $c->id]);});
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('restoraunts');
  }
}
