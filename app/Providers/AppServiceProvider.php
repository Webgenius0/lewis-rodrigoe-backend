<?php

namespace App\Providers;

use App\Interfaces\V1\Address\AddressRepositoryInterface;
use App\Interfaces\V1\Auth\ForgetPasswordRepositoryInterface;
use App\Interfaces\V1\Auth\OTPRepositoryInterface;
use App\Interfaces\V1\Auth\PasswordRepositoryInterface;
use App\Interfaces\V1\Auth\UserRepositoryInterface;
use App\Interfaces\V1\Role\RoleRepositoryInterface;
use App\Interfaces\V1\Service\ServiceRepositoryInterface;
use App\Repositories\V1\Address\AddressRepository;
use App\Repositories\V1\Auth\ForgetPasswordRepository;
use App\Repositories\V1\Auth\OTPRepository;
use App\Repositories\V1\Auth\PasswordRepository;
use App\Repositories\V1\Auth\UserRepository;
use App\Repositories\V1\Role\RoleRepository;
use App\Repositories\V1\Service\ServiceRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // auth
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(ForgetPasswordRepositoryInterface::class, ForgetPasswordRepository::class);
        $this->app->bind(OTPRepositoryInterface::class, OTPRepository::class);
        $this->app->bind(PasswordRepositoryInterface::class, PasswordRepository::class);

        // role
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);

        // service
        $this->app->bind(ServiceRepositoryInterface::class, ServiceRepository::class);

        // address
        $this->app->bind(AddressRepositoryInterface::class, AddressRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
