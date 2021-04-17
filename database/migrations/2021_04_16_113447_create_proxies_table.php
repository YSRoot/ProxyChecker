<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProxiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proxy_lists', function (Blueprint $table) {
            $table->id();
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('proxies', function (Blueprint $table) {
            $table->id();
            $table->string('ip');
            $table->unsignedSmallInteger('port');
            $table->string('real_ip')->nullable();
            $table->enum('type', ['http', 'socks'])->nullable();
            $table->unsignedBigInteger('speed')->nullable();
            $table->string('geo')->nullable();
            $table->enum('status', ['enabled', 'disabled']);
            $table->boolean('is_checked')->default(false);
            $table->unsignedBigInteger('check_time_sec')->default(0);
            $table->timestamps();
        });

        Schema::create('proxy_proxy_list', function (Blueprint $table) {
            $table->foreignId('proxy_list_id');
            $table->foreignId('proxy_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proxy_list_proxy');
        Schema::dropIfExists('proxies');
        Schema::dropIfExists('proxy_lists');
    }
}
