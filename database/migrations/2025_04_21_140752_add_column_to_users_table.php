<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('social_sub_id')->nullable()->after('id');
            $table->string('provider_account', 55)->nullable()->after('social_sub_id');
            $table->unique(['social_sub_id', 'provider_account']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('social_sub_id');
            $table->dropColumn('provider_account');
            $table->dropUnique(['social_sub_id', 'provider_account']);
        });
    }
};
