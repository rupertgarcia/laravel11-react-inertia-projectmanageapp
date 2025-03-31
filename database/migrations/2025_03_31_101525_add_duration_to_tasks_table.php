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
        Schema::table('tasks', function (Blueprint $table) {
            // Change due_date from string to timestamp
            $table->dropColumn('due_date');
            $table->timestamp('due_date')->nullable()->after('priority');

            // Add duration column
            $table->time('duration')->nullable()->after('due_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            // Revert changes
            $table->dropColumn('duration');
            $table->string('due_date')->nullable()->after('priority');
        });
    }
};
