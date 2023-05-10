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
        Schema::create('staffs', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->nullable()->unique();
            $table->string('name')->nullable(false);
            $table->string('phone');
            $table->string('email');
            $table->text('address');
            $table->date('start_date');
            $table->date('end_date')->nullable(true);
            $table->double('sallery_amount')->default(0);
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
        Schema::dropIfExists('staffs');
    }
};
