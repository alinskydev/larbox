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
        $link = env('APP_URL') . '/telescope/';

        DB::statement("
            CREATE OR REPLACE VIEW view_telescope_process_by_duration
            AS
            SELECT
                CONCAT(
                    '$link',
                    telescope_entries.type,
                    's/',
                    telescope_entries.uuid
                ) as link,
                (telescope_entries.content->>'duration')::integer AS duration,
                (telescope_entries.content->>'memory')::integer AS memory,
 	            telescope_entries.type,
                telescope_entries.content,
                telescope_entries.created_at
            FROM
                telescope_entries
            WHERE
                telescope_entries.content->>'duration' IS NOT NULL
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
        DB::statement('DROP VIEW IF EXISTS view_telescope_process_by_duration');
    }
};
