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
            CREATE OR REPLACE VIEW view_telescope_query_by_duration
            AS
            SELECT
                CONCAT('$link', telescope_entries.uuid) as link,
                ROUND((telescope_entries.content->>'time')::numeric) AS duration,
                CONCAT(telescope_entries.content->>'file', ':', telescope_entries.content->>'line') AS file,
                telescope_entries.content,
                telescope_entries.created_at
            FROM
                telescope_entries
            WHERE
                telescope_entries.type = 'query'
            ORDER BY
                duration DESC;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS view_telescope_query_by_duration');
    }
};
