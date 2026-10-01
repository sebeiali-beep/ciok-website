<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ═══ TENDERS ═══
        Schema::table('tenders', function (Blueprint $table) {
            $table->enum('approval_status', ['pending', 'approved', 'rejected'])
                  ->default('pending')
                  ->after('is_published');
            $table->unsignedBigInteger('approved_by')->nullable()->after('approval_status');
            $table->timestamp('approved_at')->nullable()->after('approved_by');
            $table->text('rejection_reason')->nullable()->after('approved_at');
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('set null');
        });

        // ═══ POSTS ═══
        Schema::table('posts', function (Blueprint $table) {
            $table->enum('approval_status', ['pending', 'approved', 'rejected'])
                  ->default('pending')
                  ->after('is_published');
            $table->unsignedBigInteger('approved_by')->nullable()->after('approval_status');
            $table->timestamp('approved_at')->nullable()->after('approved_by');
            $table->text('rejection_reason')->nullable()->after('approved_at');
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('set null');
        });

        // ═══ PRODUCTS ═══
        Schema::table('products', function (Blueprint $table) {
            $table->enum('approval_status', ['pending', 'approved', 'rejected'])
                  ->default('pending')
                  ->after('is_active');
            $table->unsignedBigInteger('approved_by')->nullable()->after('approval_status');
            $table->timestamp('approved_at')->nullable()->after('approved_by');
            $table->text('rejection_reason')->nullable()->after('approved_at');
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('tenders', function (Blueprint $table) {
            $table->dropForeign(['approved_by']);
            $table->dropColumn(['approval_status', 'approved_by', 'approved_at', 'rejection_reason']);
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['approved_by']);
            $table->dropColumn(['approval_status', 'approved_by', 'approved_at', 'rejection_reason']);
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['approved_by']);
            $table->dropColumn(['approval_status', 'approved_by', 'approved_at', 'rejection_reason']);
        });
    }
};