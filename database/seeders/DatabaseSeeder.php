<?php

namespace Database\Seeders;

use App\Models\fournisseur;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory(10)->create();
         
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        //creation de la factory
        // user::factory()->create([
        //     'name'=>'douc',
        //     'email'=>'douc@gmail.com',
        //     'password'=> bcrypt('bko2026'),
            
        // ]);

       

        //appellation de seeder 
        $this->call(UserSeeder::class);
        $this->call(PatientSeeder::class);
        // $this->call(MedicamentSeeder::class, );
        
       // $this->call(FournisseurSeeder::class);
    }
}
