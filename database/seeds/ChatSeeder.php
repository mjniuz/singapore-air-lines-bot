<?php

use App\Models\Chat;
use Illuminate\Database\Seeder;

class ChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $new_chat = [
            'format_chat'  => 'SA_DATE_DESTINATION-LOCATION_FROM-LOCATION',
            'example_chat' => 'SA_2017-12-12_Jakarta_Singapore',
            'count_chat'   => '3',
        ];

        $chat = Chat::create($new_chat);
    }
}
