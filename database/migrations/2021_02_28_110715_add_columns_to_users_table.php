<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
             $table->text('address')->nullable()->after('name');
             $table->string('city')->nullable()->after('address');
             $table->string('state')->nullable()->after('city');
             $table->string('country')->nullable()->after('state');
             $table->string('zipcode')->nullable()->after('country');
             $table->string('mobile')->nullable()->after('zipcode');
             $table->tinyInteger('status')->default(1)->after('password');
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
            $table->dropColumn('address');
            $table->dropColumn('city');
            $table->dropColumn('state');
            $table->dropColumn('country');
            $table->dropColumn('zipcode');
            $table->dropColumn('mobile');
            $table->dropColumn('status');
        });
    }
}
