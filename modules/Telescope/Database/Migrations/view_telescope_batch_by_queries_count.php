<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $link = env('APP_URL') . '/telescope/queries/';

        DB::statement("
            CREATE OR REPLACE VIEW view_telescope_batch_by_queries_count
            AS
            SELECT
                CONCAT('$link', MIN(telescope_entries.uuid::text)) as link,
 	            telescope_entries.batch_id,
                COUNT(telescope_entries.*) as total_count
            FROM
                telescope_entries
            WHERE
                type = 'query'
            GROUP BY
                batch_id
            ORDER BY
                total_count DESC;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS view_telescope_batch_by_queries_count');
    }
};
