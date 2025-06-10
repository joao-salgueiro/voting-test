<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('options', function (Blueprint $table) {
        $table->foreignId('poll_id')->constrained()->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('options', function (Blueprint $table) {
        $table->dropForeign(['poll_id']);
        $table->dropColumn('poll_id');
    });
}
};
