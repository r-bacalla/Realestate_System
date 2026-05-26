<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            if (!Schema::hasColumn('properties', 'title')) {
                $table->string('title')->nullable()->after('name');
            }
            if (!Schema::hasColumn('properties', 'about')) {
                $table->text('about')->nullable()->after('description');
            }
        });
    }

    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            if (Schema::hasColumn('properties', 'about')) {
                $table->dropColumn('about');
            }
            if (Schema::hasColumn('properties', 'title')) {
                $table->dropColumn('title');
            }
        });
    }
};
