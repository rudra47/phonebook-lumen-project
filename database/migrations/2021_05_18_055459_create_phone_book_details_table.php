<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhoneBookDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phone_book_details', function (Blueprint $table) {
            $table->id();
            $table->string('fullname', 100)->collation('utf8_general_ci');
            $table->string('number_one', 50)->collation('utf8_general_ci');
            $table->string('number_two', 50)->collation('utf8_general_ci');
            $table->string('email', 100);
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
        Schema::dropIfExists('phone_book_details');
    }
}
