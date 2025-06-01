<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Male Fees (Standard Membership)
        $maleFees = [
            ['membership_duration' => '1 month for general', 'fees_amount' => '3500'],
            ['membership_duration' => '3 months for general', 'fees_amount' => '8000'],
            ['membership_duration' => '6 months for general', 'fees_amount' => '12500'],
            ['membership_duration' => '12 months for general', 'fees_amount' => '20000'],
        ];

        // Female Fees (General Membership + Aerobics/Zumba)
        $femaleFees = [
            ['membership_duration' => '1 month for aerobics', 'fees_amount' => '3800'],
            ['membership_duration' => '3 months for aerobics', 'fees_amount' => '9800'],
            ['membership_duration' => '6 months for aerobics', 'fees_amount' => '15500'],
            ['membership_duration' => '12 months for aerobics', 'fees_amount' => '28500'],
        ];

        // Insert male fees
        foreach ($maleFees as $fee) {
            DB::table('fees')->insert([
                'membership_duration' => $fee['membership_duration'],
                'fees_amount' => $fee['fees_amount'],
                'category' => 'male',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Insert female fees
        foreach ($femaleFees as $fee) {
            DB::table('fees')->insert([
                'membership_duration' => $fee['membership_duration'],
                'fees_amount' => $fee['fees_amount'],
                'category' => 'female',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Create structured packages with features for a more attractive display
        $this->createPackages();
    }

    protected function createPackages()
    {
        // Basic Male Packages
        $malePackages = [
            [
                'name' => 'General Membership - 1 Month',
                'description' => 'Standard gym access',
                'price' => 3500, 
                'features' => json_encode(['Access to gym facilities', 'Free locker usage']),
                'category' => 'male',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'General Membership - 3 Months',
                'description' => 'Best value for regular gym goers',
                'price' => 8000,
                'features' => json_encode(['Access to gym facilities', 'Free locker usage', '1 personal training session']),
                'category' => 'male',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'General Membership - 6 Months',
                'description' => 'Dedicated fitness solution for 6 months',
                'price' => 12500,
                'features' => json_encode(['Access to gym facilities', 'Free locker usage', '5 personal training sessions', 'Nutrition plan']),
                'category' => 'male',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'General Membership - 12 Months',
                'description' => 'Complete year-long fitness journey',
                'price' => 20000,
                'features' => json_encode(['Access to gym facilities', 'Free locker usage', '10 personal training sessions', 'Nutrition plan', 'Free fitness assessment']),
                'category' => 'male',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Female Packages with Aerobics/Zumba
        $femalePackages = [
            [
                'name' => 'Aerobics Package - 1 Month',
                'description' => 'Gym access with aerobics classes',
                'price' => 3800, 
                'features' => json_encode(['Access to gym facilities', 'Aerobics classes', 'Free locker usage']),
                'category' => 'female',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Aerobics Package - 3 Months',
                'description' => 'Complete fitness package with aerobics',
                'price' => 9800,
                'features' => json_encode(['Access to gym facilities', 'Aerobics classes', 'Free locker usage', '1 personal training session']),
                'category' => 'female',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Aerobics Package - 6 Months',
                'description' => 'Premium fitness solution with aerobics for 6 months',
                'price' => 15500,
                'features' => json_encode(['Access to gym facilities', 'Aerobics classes', 'Free locker usage', '5 personal training sessions', 'Nutrition plan']),
                'category' => 'female',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Aerobics Package - 12 Months',
                'description' => 'Complete year-long wellness program with aerobics',
                'price' => 28500,
                'features' => json_encode(['Access to gym facilities', 'Aerobics classes', 'Free locker usage', '10 personal training sessions', 'Nutrition plan', 'Free fitness assessment']),
                'category' => 'female',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert male packages
        foreach ($malePackages as $package) {
            DB::table('packages')->insert($package);
        }

        // Insert female packages
        foreach ($femalePackages as $package) {
            DB::table('packages')->insert($package);
        }
    }
}