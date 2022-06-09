<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableExpenseSplit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expense_split', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('expense_id');
            $table->unsignedBigInteger('borrower_id');
            $table->unsignedBigInteger('paid_by');
            $table->string('due_amount');
            $table->string('split_type');
            $table->timestamps();


            $table->foreign('expense_id')->references('id')->on('expense');
            $table->foreign('borrower_id')->references('id')->on('users');
            $table->foreign('paid_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expense_split');
    }
}
