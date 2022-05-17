<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

return new class extends Seeder
{
    public function run()
    {
        DB::table('task')->insert([
            [
                'agent_id' => 2,
                'type' => 'v',
                'name' => 'Task 1',
                'description' => 'Description 1',
                'execution_comment' => 'Execution comment 1',
                'deadline' => date('Y-m-d', strtotime('+1 day')),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'agent_id' => 2,
                'type' => 'v',
                'name' => 'Task 2',
                'description' => null,
                'execution_comment' => null,
                'deadline' => date('Y-m-d', strtotime('-1 day')),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
};
