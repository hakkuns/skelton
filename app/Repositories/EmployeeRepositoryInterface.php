<?php

namespace App\Repositories;

use App\Repositories\BaseRepositoryInterface;
use App\Models\Employee;
use Illuminate\Support\Collection;

interface EmployeeRepositoryInterface extends BaseRepositoryInterface
{
    public function listEmployees(string $order = 'id', string $sort = 'desc'): Collection;

    public function createEmployee(array $params) : Employee;

    public function findEmployeeById(int $id) : Employee;

    public function updateEmployee(array $params): bool;

    public function isAuthUser(Employee $employee): bool;

    public function deleteEmployee() : bool;
}
