<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class FixArticlesCollation extends Migration
{
    /**
     * Run the migrations.
     * 
     * Changes the articles table collation from latin1_general_ci to utf8mb4_unicode_ci
     * to support accent-insensitive searches while preserving existing data.
     *
     * @return void
     */
    public function up()
    {
        // Convert the entire table to utf8mb4_unicode_ci
        DB::statement('ALTER TABLE articles CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci');
        
        // Explicitly set collation for title and content columns
        DB::statement('ALTER TABLE articles MODIFY title VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci');
        DB::statement('ALTER TABLE articles MODIFY content TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Revert back to original collation
        DB::statement('ALTER TABLE articles CONVERT TO CHARACTER SET latin1 COLLATE latin1_general_ci');
        DB::statement('ALTER TABLE articles MODIFY title VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_general_ci');
        DB::statement('ALTER TABLE articles MODIFY content TEXT CHARACTER SET latin1 COLLATE latin1_general_ci');
    }
}
