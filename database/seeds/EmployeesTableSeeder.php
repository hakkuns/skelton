<?php

use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeesTableSeeder extends Seeder
{
    public function run()
    {
        $employee = factory(Employee::class)->create([
            'email' => 'admin@example.com'
        ]);
    }
}
