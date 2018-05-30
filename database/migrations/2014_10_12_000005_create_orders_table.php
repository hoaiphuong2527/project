<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('order_date')->useCurrent(); //Ngay muon sach
            $table->dateTime('expired_date'); //Ngay phai tra
            $table->dateTime('return_date')->nullable()->default(null); //Ngay tra thuc te
            $table->unsignedInteger('borrower_id')->nullable()->default(null);
            $table->integer('status')->default(0);          //0: Dang muon, 1: Da tra, 2: Da that lac
            $table->timestamps();
            $table->unsignedInteger('created_by')->nullable()->default(null);
            $table->unsignedInteger('updated_by')->nullable()->default(null);
            $table->foreign('borrower_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
