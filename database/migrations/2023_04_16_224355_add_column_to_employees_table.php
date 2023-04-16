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
            $table->string('email')->unique()->after('name')->nullable();
            $table->string('place_of_birth')->after('email')->nullable();
            $table->text('address')->after('nip')->nullable();
            $table->string('phone_number')->after('awards')->nullable();
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
            $table->dropUnique(['email']);
            $table->dropColumn(['email', 'place_of_birth', 'address', 'phone_number']);
        });
    }
};
