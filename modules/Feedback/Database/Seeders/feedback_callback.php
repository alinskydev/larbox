<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Helpers\SeederHelper;
use Modules\Feedback\Enums\FeedbackStatusEnum;

return new class extends Seeder
{
    public function run()
    {
        DB::table('feedback_callback')->insert([
            [
                'full_name' => 'Full name 1',
                'phone' => '+998 00 000 00 01',
                'message' => 'Message 1',
                'status' => FeedbackStatusEnum::UNPROCESSED->value,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'full_name' => 'Full name 2',
                'phone' => '+998 00 000 00 02',
                'message' => null,
                'status' => FeedbackStatusEnum::UNPROCESSED->value,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
};
