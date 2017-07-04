<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdditionalFieldsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->nullable()->after('password');
            $table->string('last_name')->nullable()->after('first_name');
            $table->string('timezone')->default('UTC')->after('last_name');
            $table->boolean('is_active')->default(false)->after('timezone');
            $table->datetime('last_login_at')->nullable()->after('is_active');
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
            $table->dropColumn([
                'last_login_at',
                'is_active',
                'timezone',
                'last_name',
                'first_name',
            ]);
        });
    }
}
