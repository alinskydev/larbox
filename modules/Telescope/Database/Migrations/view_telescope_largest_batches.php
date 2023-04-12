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
            CREATE OR REPLACE VIEW view_telescope_largest_batches
            AS
            SELECT
                CONCAT('$link', telescope_entries.type,  's/', MIN(telescope_entries.uuid::text)) as link,
 	            telescope_entries.batch_id,
 	            telescope_entries.type,
                count(telescope_entries.*) as total_count
            FROM
                telescope_entries
            GROUP BY
                batch_id,
                type
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
        DB::statement('DROP VIEW IF EXISTS view_telescope_largest_batches');
    }
};
