<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) 
            {
                $table->id();
                $table->string('slug')->unique();
                $table->string('email')->unique(); 
                $table->string('name'); 
                $table->text('address');
                $table->string('contact_number')->nullable();
                $table->string('contact_person')->nullable();
                $table->string('tin_number')->nullable();
                $table->string('type')->nullable();
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
