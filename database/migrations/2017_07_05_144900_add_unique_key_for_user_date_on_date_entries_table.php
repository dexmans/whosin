<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUniqueKeyForUserDateOnDateEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('date_entries', function (Blueprint $table) {
            $table->unique(['user_id', 'entry_date'], 'user_id_entry_date_date_entries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('date_entries', function (Blueprint $table) {
            $table->dropUnique('user_id_entry_date_date_entries');
        });
    }
}
