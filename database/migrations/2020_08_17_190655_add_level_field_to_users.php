<?php

use App\Constants\UserLevel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLevelFieldToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string("level")->default(UserLevel::ADMIN_PUSKESMAS);
            $table->index("level");
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string("level")->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn("level");
        });
    }
}
