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
        Schema::create('client_transactions', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->nullable(false)->unique();
            $table->unsignedBigInteger('global_transaction_id');
            $table->foreign('global_transaction_id')->references('id')->on('global_transactions')->onDelete('cascade');
            $table->string('reference')->nullable();
            $table->integer('title')->default(\App\Helpers\Constant::TRANSACTIONS['tranaction']);
            $table->text('particulars')->nullable();
            $table->double('debit_amount')->default(0);
            $table->double('credit_amount')->default(0);
            $table->double('balance')->default(0);
            $table->foreignId('banking_id')->nullable();
            $table->foreignId('project_id')->nullable(false);
            $table->foreignId('client_id')->nullable(false);
            $table->foreignId('user_id')->nullable(false);
            $table->text('note')->nullable();
            $table->enum('trans_type', array('debit','credit'))->nullable(false);
            $table->date('trans_date')->default(now());
            $table->timestamps();
            $table->index(['reference', 'client_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_transactions');
    }
};
