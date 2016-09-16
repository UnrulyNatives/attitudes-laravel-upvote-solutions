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
            'text' => 'I never learned from a man who agreed with me.',
            'author' => 'Robert A. Heinlein',

        ]);



    }
}
