<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call ( WeaponsTableSeeder::class );
		$this->call ( BadgesTableSeeder::class );
		$this->call ( ChestsTableSeeder::class );
		$this->call ( ClassesTableSeeder::class );
		$this->call ( FragmentsTableSeeder::class );
		$this->call ( KeysTableSeeder::class );
		$this->call ( PeteggsTableSeeder::class );
		$this->call ( UsergradesTableSeeder::class );
    }
}
