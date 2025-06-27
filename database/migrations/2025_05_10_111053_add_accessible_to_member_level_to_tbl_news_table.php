<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tbl_news', function (Blueprint $table) {
            $table->tinyInteger('accessible_to_member_level')->default(1)->comment('1=Free, 2=Limited Premium, 3=Premium');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_news', function (Blueprint $table) {
            //
        });
    }
};
