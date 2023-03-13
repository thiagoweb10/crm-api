<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demand_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('demand_id')->unsigned()->constrained()->references('id')->on('demands');
            $table->foreignId('created_by')->constrained()->references('id')->on('users');
            $table->foreignId('developer_id')->constrained()->references('id')->on('users');
            $table->foreignId('status_id')->constrained()->references('id')->on('demand_statuses');
            $table->text('comment');
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
        Schema::dropIfExists('demand_logs');
    }
}
