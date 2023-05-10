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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->nullable()->unique();
            $table->string('name')->nullable(false);
            $table->string('phone');
            $table->string('phone_2')->nullable(true);
            $table->string('email');
            $table->text('address');
            $table->string('billing_name');
            $table->string('billing_phone');
            $table->text('billing_address');
            $table->text('description')->nullable(true);
            $table->integer('status')->default(\App\Helpers\Constant::ROW_STATUS['active']);
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
        Schema::dropIfExists('vendors');
    }
};
