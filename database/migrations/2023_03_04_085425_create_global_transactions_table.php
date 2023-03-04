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
        Schema::create('global_transactions', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->nullable(false)->unique();
            $table->integer('title')->default(\App\Helpers\Constant::TRANSACTIONS['tranaction']);
            $table->string('reference')->nullable();
            $table->foreignId('banking_id')->nullable();
            $table->foreignId('project_id')->nullable();
            $table->foreignId('client_id')->nullable();
            $table->foreignId('vendor_id')->nullable();
            $table->foreignId('office_id')->nullable();
            $table->foreignId('loan_id')->nullable();
            $table->json('trans_history')->nullable();
            $table->double('amount')->default(0);
            $table->date('trans_date')->default(now());
            $table->foreignId('user_id')->nullable(false);
            $table->timestamps();
            $table->index(['reference', 'banking_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('global_transactions');
    }
};
