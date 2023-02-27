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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->nullable()->unique();
            $table->string('project_title')->nullable(false);
            $table->date('start_date');
            $table->date('end_date');
            $table->bigInteger('client')->nullable(false);
            $table->double('project_price')->default(0);
            $table->integer('status')->default(\App\Helpers\Constant::PROJECT_STATUS['not_started']);
            $table->text('description');
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
        Schema::dropIfExists('projects');
    }
};
