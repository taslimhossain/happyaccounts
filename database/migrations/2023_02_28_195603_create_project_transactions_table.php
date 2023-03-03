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
        Schema::create('project_transactions', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->nullable()->unique();
            $table->string('reference')->nullable();
            $table->integer('title')->default(\App\Helpers\Constant::PROJECT_TRANSACTIONS['tranaction']);
            $table->text('particulars')->nullable();
            $table->foreignId('user_id')->nullable(false);
            $table->foreignId('project_id')->nullable(false);
            $table->foreignId('vendor_id')->nullable();
            $table->foreignId('client_id')->nullable();
            $table->foreignId('expenses_id')->nullable();
            $table->foreignId('banking_id')->nullable();
            $table->double('debit_amount')->default(0);
            $table->double('credit_amount')->default(0);
            $table->double('balance')->default(0);
            $table->text('note')->nullable();
            $table->json('trans_history')->nullable();
            $table->enum('trans_type', array('debit','credit'))->nullable(false);
            $table->dateTime('trans_time')->default(now());
            $table->date('trans_date')->default(now());
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
        Schema::dropIfExists('project_transactions');
    }
};
