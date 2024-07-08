<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return  new class  extends Migration
{
    public function up()
    {
        Schema::create('elements', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('inventory')->nullable();
            $table->string('type'); // 'part' or 'bundle'
            $table->timestamps();
        });

        Schema::create('element_element', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->constrained('elements')->onDelete('cascade');
            $table->foreignId('child_id')->constrained('elements')->onDelete('cascade');
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('element_element');
        Schema::dropIfExists('elements');
    }
};
