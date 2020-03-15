<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
                // we need user ifd to create one to one relationship
            $table->integer('user_id');
            // now lets make avatar, about,
          //  and facebook as user may not have these always
            $table->string('avatar')->nullable();
            $table->text('about')->nullable();
            $table->string('facebook')->nullable();
            // and so on
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
        Schema::dropIfExists('profiles');
    }
}
