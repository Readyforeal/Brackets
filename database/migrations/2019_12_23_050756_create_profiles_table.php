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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('profile_image')->nullable();
            $table->string('name')->nullable();
            $table->date('dob')->nullable();
            $table->text('about')->nullable();
            $table->string('job_title')->nullable();
            $table->string('job_employer')->nullable();
            $table->string('institution')->nullable();
            $table->date('graduation_year')->nullable();
            $table->json('interests')->nullable();
            $table->string('gender')->nullable();
            $table->string('location')->nullable();
            $table->timestamps();

            $table->index('user_id');
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
