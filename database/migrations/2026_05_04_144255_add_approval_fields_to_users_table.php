<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
        if (!Schema::hasColumn('users', 'is_approved')) {
            $table->boolean('is_approved')->default(false)->after('email');
        }
        if (!Schema::hasColumn('users', 'valid_id_path')) {
            $table->string('valid_id_path')->nullable()->after('is_approved');
        }
        if (!Schema::hasColumn('users', 'rejected_at')) {
            $table->timestamp('rejected_at')->nullable()->after('valid_id_path');
        }
        if (!Schema::hasColumn('users', 'rejection_reason')) {
            $table->text('rejection_reason')->nullable()->after('rejected_at');
        }
        if (!Schema::hasColumn('users', 'role')) {
            $table->enum('role', ['resident', 'admin'])->default('resident')->after('rejection_reason');
        }
        if (!Schema::hasColumn('users', 'approved_at')) {
            $table->timestamp('approved_at')->nullable()->after('role');
        }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['is_approved', 'valid_id_path', 'rejected_at', 'rejection_reason']);
        });
    }
};