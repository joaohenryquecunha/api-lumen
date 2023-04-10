<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('redirect', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('link_id');
            $table->string('url', 255);
            $table->boolean('status')->default(true);
            $table->integer('current_click')->default(0);
            $table->integer('max_click')->default(0);
            $table->timestamp('created_at')->default(db::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(db::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        
            $table->foreign('link_id')->references('id')->on('link')->onDelete('cascade');
        });
    }
        
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('redirect');
    }
};
