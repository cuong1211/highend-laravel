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
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['description', 'preview']);
            $table->integer('description_id')->nullable()->after('slug');
            $table->integer('review_id')->nullable()->after('description_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['description_id', 'review_id']);
            $table->longText('description')->nullable()->after('slug');
            $table->longText('preview')->nullable()->after('description');
        });
    }
};
