<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('website')->nullable();
            $table->longText('logo')->nullable();
            $table->longText('banner_image')->nullable();
            $table->timestamps();
        });        

        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organization_id');
            $table->string('title');
            $table->text('description');
            $table->dateTime('event_date');
            $table->longText('image')->nullable(); // <-- Ensure this exists
            $table->timestamps();
        
            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
        });        

        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organization_id');
            $table->string('title');
            $table->text('description'); // Make sure this exists
            $table->longText('image')->nullable();
            $table->timestamps();
        
            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
        });        

        Schema::create('organization_banners', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organization_id');
            $table->longText('banner_image');
            $table->timestamps();
            
            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('organization_banners');
        Schema::dropIfExists('articles');
        Schema::dropIfExists('events');
        Schema::dropIfExists('organizations');
    }
};
