<?php


use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class TesteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->command->info("Seeder module executada");
        // $this->call("OthersTableSeeder");
    }
}
