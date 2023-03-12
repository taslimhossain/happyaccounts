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
        Schema::create('office_transactions', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->nullable(false)->unique();
            $table->unsignedBigInteger('global_transaction_id');
            $table->foreign('global_transaction_id')->references('id')->on('global_transactions')->onDelete('cascade');
            $table->string('reference')->nullable(true);
            $table->integer('title')->default(\App\Helpers\Constant::TRANSACTIONS['tranaction']);
            $table->text('particulars')->nullable(true);
            $table->double('debit_amount')->default(0);
            $table->double('credit_amount')->default(0);
            $table->foreignId('banking_id')->nullable(false);
            $table->foreignId('staff_id')->nullable(true);
            $table->foreignId('expenses_id')->nullable(true);
            $table->foreignId('user_id')->nullable(false);
            $table->text('note')->nullable();
            $table->enum('trans_type', array('debit','credit'))->nullable(false);
            $table->enum('is_salary', array('yes','no'))->default('no');
            $table->date('trans_date')->default(now());
            $table->timestamps();
            $table->index(['reference', 'staff_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('office_transactions');
    }
};
