<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\QueryException;

return new class extends Migration
{
    private function addIndexSafe($table, $column)
    {
        try {
            Schema::table($table, function (Blueprint $t) use ($column) {
                $t->index($column);
            });
        } catch (QueryException $e) {
            // 1061 is Duplicate key name in MySQL
            if ($e->errorInfo[1] != 1061) {
                throw $e;
            }
        }
    }

    private function dropIndexSafe($table, $column)
    {
        try {
            Schema::table($table, function (Blueprint $t) use ($column) {
                $t->dropIndex([$column]);
            });
        } catch (QueryException $e) {
            // 1091 is Can't DROP 'index'; check that column/key exists
            if ($e->errorInfo[1] != 1091) {
                throw $e;
            }
        }
    }

    public function up(): void
    {
        $this->addIndexSafe('books', 'created_by');
        $this->addIndexSafe('books', 'created_at');
        $this->addIndexSafe('books', 'department_id');

        $this->addIndexSafe('borrowers', 'created_by');
        $this->addIndexSafe('borrowers', 'created_at');
        $this->addIndexSafe('borrowers', 'student_id');
        $this->addIndexSafe('borrowers', 'status');

        $this->addIndexSafe('attendances', 'created_at');
        $this->addIndexSafe('attendances', 'student_id');

        $this->addIndexSafe('users', 'department_id');
        $this->addIndexSafe('users', 'user_type');
        $this->addIndexSafe('users', 'activated');
    }

    public function down(): void
    {
        $this->dropIndexSafe('books', 'created_by');
        $this->dropIndexSafe('books', 'created_at');
        $this->dropIndexSafe('books', 'department_id');

        $this->dropIndexSafe('borrowers', 'created_by');
        $this->dropIndexSafe('borrowers', 'created_at');
        $this->dropIndexSafe('borrowers', 'student_id');
        $this->dropIndexSafe('borrowers', 'status');

        $this->dropIndexSafe('attendances', 'created_at');
        $this->dropIndexSafe('attendances', 'student_id');

        $this->dropIndexSafe('users', 'department_id');
        $this->dropIndexSafe('users', 'user_type');
        $this->dropIndexSafe('users', 'activated');
    }
};
