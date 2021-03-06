<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantsTable extends Migration
{
    private $tableName = 'merchants';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchants', function (Blueprint $table) {
            $table->string('uuid', 36)->primary('uuid')->nullable(false)->comment('商戶uid');
            $table->string('name', 100)->comment('商戶名稱');
            $table->dateTime('expired_at')->comment('到期日');
            $table->tinyInteger('status')->comment('狀態');
            $table->timestamps();

            $table->unsignedBigInteger('user_id')->comment('mapping users.id');
            $table->unsignedBigInteger('cdn_plan_id')->comment('mapping cnd_plans.id')->nullable();
            $table->unsignedBigInteger('default_line_id')->comment('mapping lines.id')->nullable();
            $table->unsignedBigInteger('deliver_domain_id')->comment('mapping domains.id')->nullable();
            $table->string('code', 50)->comment('商戶代碼');

            $table->foreign('user_id', "fk_{$this->tableName}_user_id")->references('id')->on('users')->onDelete('CASCADE'); //TODO: need to check relationship
            $table->foreign('cdn_plan_id', "fk_{$this->tableName}_cdn_plan_id")->references('id')->on('cdn_plans')->onDelete('CASCADE');
            $table->foreign('default_line_id', "fk_{$this->tableName}_default_line_id")->references('id')->on('lines')->onDelete('CASCADE');
            $table->foreign('deliver_domain_id', "fk_{$this->tableName}_deliver_domain_id")->references('id')->on('domains')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merchants');
    }
}
