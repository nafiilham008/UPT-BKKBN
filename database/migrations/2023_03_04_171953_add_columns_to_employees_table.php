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
        Schema::table('employees', function (Blueprint $table) {
            $table->date('birthdate')->nullable()->after('nip');
            $table->text('education_history')->nullable()->after('birthdate');
            $table->text('employment_history')->nullable()->after('education_history');
            $table->text('awards')->nullable()->after('employment_history');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn('birthdate');
            $table->dropColumn('education_history');
            $table->dropColumn('employment_history');
            $table->dropColumn('awards');
        });
    }
};
