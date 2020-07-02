<?php

namespace App\Repositories;

use App\Repositories\BaseRepositoryInterface;
use App\Models\News;
use Illuminate\Support\Collection;

interface NewsRepositoryInterface extends BaseRepositoryInterface
{
   public function list(string $order = 'id', string $sort = 'desc', array $columns = ['*']) : Collection;
}
