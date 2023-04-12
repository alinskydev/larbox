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
        $link = env('APP_URL') . '/telescope/requests/';

        DB::statement("
            CREATE OR REPLACE VIEW view_telescope_requests
            AS
            SELECT
                CONCAT('$link', telescope_entries.uuid::text) as link,
                (telescope_entries.content->>'duration')::integer AS duration,
                (telescope_entries.content->>'memory')::integer AS memory,
                telescope_entries.content->>'method' AS method,
                (telescope_entries.content->>'response_status')::integer AS status,
                telescope_entries.content->>'uri' AS url,
                telescope_entries.content,
                telescope_entries.created_at
            FROM
                telescope_entries
            WHERE
                telescope_entries.type = 'request' AND
                telescope_entries.content->>'method' != 'OPTIONS';
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS view_telescope_requests');
    }
};
