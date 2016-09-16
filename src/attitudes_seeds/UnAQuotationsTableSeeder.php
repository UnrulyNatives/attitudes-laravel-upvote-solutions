<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB;

class UnAQuotationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {




        DB::table('un_a_quotations')->insert([
            ['text' => 'I never learned from a man who agreed with me.', 'author' => 'Robert A. Heinlein'],
            ['text' => 'Every great cause begins as a movement, becomes a business, and eventually degenerates into a racket.', 'author' => 'Eric Hoffer'],
            ['text' => 'The mass of men lead lives of quiet desperation and go to the grave with the song still in them.', 'author' => 'Henry David Thoreau'],
            ['text' => 'If you think education is expensive, try ignorance.', 'author' => '(multiple attributions)'],
            ['text' => 'In the beginning I was hoping it is possible to change them. But now, if I am still calling, it is only in order not to be changed by them.', 'author' => 'Orson Scott Card'],
            ['text' => 'The future influences the present just as much as the past.', 'author' => 'FRIEDRICH WILHELM NIETZSCHE'],
            ['text' => 'With the first link, a chain is forged. The first speech censured, the first thought forbidden, the first freedom denied, chains us all irrevocably.', 'author' => 'Picard'],
            ['text' => 'Be wary of technology; it is often merely an improved means to an unimproved end.', 'author' => 'Henry David Thoreau'],
            ['text' => 'Cogito cogito ergo cogito sum -- I think that I think, therefore I think that I am.', 'author' => 'unknown'],


        ]);



    }
}
