<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demands', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('request_id')->constrained();
            $table->foreignId('priority_id')->constrained();
            $table->foreignId('system_id')->constrained();

            $table->foreignId('created_by')->constrained()->references('id')->on('users');
            $table->foreignId('developer_id')->constrained()->references('id')->on('users');
            
            $table->string('title');
            $table->text('description');
            $table->text('comment');
            $table->date('date_estimated');
            $table->date('date_expected');
            $table->string('file_document');
            $table->integer('status_id')->constrained()->references('id')->on('demand_statuses');
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
        Schema::dropIfExists('demands');
    }
}
