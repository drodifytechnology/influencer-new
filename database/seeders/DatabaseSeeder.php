<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PermissionSeeder::class,
            // UserSeeder::class,
            OptionTableSeeder::class,
            CategorySeeder::class,
            CurrencySeeder::class,
            GatewaySeeder::class,
            ExpenseCategorySeeder::class,
            // ServiceSeeder::class,
            // OrderSeeder::class,
            // SupportSeeder::class,
            // WithdrawMethodSeeder::class,
            // UserMethodSeeder::class,
            // WithdrawSeeder::class,
            // TransactionSeeder::class,
            // CouponSeeder::class,
            BlogSeeder::class,
            // CategoryUser::class,
            // ExpenseListSeeder::class,
        ]);
    }
}
