<?php

namespace App\Providers;

use App\Repositories\CategoryRepository;
use App\Repositories\CategoryRepositoryInterface;

use App\Repositories\EmployeeRepository;
use App\Repositories\EmployeeRepositoryInterface;

use App\Repositories\ProductRepositoryInterface;
use App\Repositories\ProductRepository;

use App\Repositories\AttributeRepositoryInterface;
use App\Repositories\AttributeRepository;

use App\Repositories\AttributeValueRepository;
use App\Repositories\AttributeValueRepositoryInterface;

use App\Repositories\BrandRepository;
use App\Repositories\BrandRepositoryInterface;

use App\Repositories\CustomerRepository;
use App\Repositories\CustomerRepositoryInterface;

use Illuminate\Support\ServiceProvider;

use App\Repositories\AddressRepository;
use App\Repositories\AddressRepositoryInterface;

use App\Repositories\CartRepository;
use App\Repositories\CartRepositoryInterface;

use App\Repositories\ProductAttributeRepository;
use App\Repositories\ProductAttributeRepositoryInterface;

use App\Repositories\OrderStatusRepositoryInterface;
use App\Repositories\OrderStatusRepository;

use App\Repositories\OrderRepositoryInterface;
use App\Repositories\OrderRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            ProductAttributeRepositoryInterface::class,
            ProductAttributeRepository::class
        );

        $this->app->bind(
            CustomerRepositoryInterface::class,
            CustomerRepository::class
        );

        $this->app->bind(
            BrandRepositoryInterface::class,
            BrandRepository::class
        );
        
        $this->app->bind(
            AttributeValueRepositoryInterface::class,
            AttributeValueRepository::class
        );

        $this->app->bind(
            AttributeRepositoryInterface::class,
            AttributeRepository::class
        );

        $this->app->bind(
            EmployeeRepositoryInterface::class,
            EmployeeRepository::class
        );

        $this->app->bind(
            ProductRepositoryInterface::class,
            ProductRepository::class
        );

        $this->app->bind(
            CategoryRepositoryInterface::class,
            CategoryRepository::class
        );

        $this->app->bind(
            AddressRepositoryInterface::class,
            AddressRepository::class
        );

        $this->app->bind(
            AddressRepositoryInterface::class,
            AddressRepository::class
        );

        $this->app->bind(
            CartRepositoryInterface::class,
            CartRepository::class
        );

        $this->app->bind(
            OrderStatusRepositoryInterface::class,
            OrderStatusRepository::class
        );

        $this->app->bind(
            OrderRepositoryInterface::class,
            OrderRepository::class
        );
    }
}
