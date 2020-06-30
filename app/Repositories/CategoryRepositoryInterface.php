<?php

namespace App\Repositories;

use App\Repositories\BaseRepositoryInterface;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Collection;

interface CategoryRepositoryInterface extends BaseRepositoryInterface
{
   public function listCategories(string $order = 'id', string $sort = 'desc', $except = []) : Collection;

   public function listCategoriesWithProducts(string $order = 'id', string $sort = 'desc', $except = []) : Collection;

   public function createCategory(array $params) : Category;

   public function updateCategory(array $params) : Category;

   public function findCategoryById(int $id) : Category;

   public function deleteCategory() : bool;
   
   public function deleteFile(array $file, $disk = null) : bool;

   public function findCategoryBySlug(array $slug) : Category;

   public function rootCategories(string $string, string $string1);
}
