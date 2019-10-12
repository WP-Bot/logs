<?php

use Illuminate\Database\Seeder;
use App\Message;

class MessagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $max_entries_per_day = 50;
        $spread_over_days = 7;

        $types = [
            'message',
            'quit',
            'part',
            'kick',
            'join',
            'mod_request',
        ];

        $faker = \Faker\Factory::create();

        $total_entries = ( $max_entries_per_day * $spread_over_days );

        for ( $i = 0; $i <= $total_entries; $i++ ) {
            DB::table('messages')->insert([
                'userhost' => sprintf(
                    '%s!%s@%s',
                    $faker->userName,
                    $faker->firstName,
                    $faker->domainName
                ),
                'nickname' => $faker->userName,
                'message' => $faker->text( 255 ),
                'event' => $faker->randomElement( $types ),
                'is_question' => $faker->randomElement( [ 0, 1 ] ),
                'time' => $faker->dateTimeBetween( sprintf( '-%d days', $spread_over_days ), sprintf( '+%d days', $spread_over_days ), 'UTC' )
            ]);
        }
    }
}
