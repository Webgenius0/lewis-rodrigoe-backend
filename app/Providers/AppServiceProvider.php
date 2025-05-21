<?php

namespace App\Providers;

use App\Interfaces\V1\Address\AddressRepositoryInterface;
use App\Interfaces\V1\Address\City\CityRepositoryInterface;
use App\Interfaces\V1\Address\Country\CountryRepositoryInterface;
use App\Interfaces\V1\Address\State\StateRepositoryInterface;
use App\Interfaces\V1\Address\Zip\ZipRepositoryInterface;
use App\Interfaces\V1\Auth\ForgetPasswordRepositoryInterface;
use App\Interfaces\V1\Auth\OTPRepositoryInterface;
use App\Interfaces\V1\Auth\PasswordRepositoryInterface;
use App\Interfaces\V1\Auth\UserRepositoryInterface;
use App\Interfaces\V1\BankAccount\BankAccountRepositoryInterface;
use App\Interfaces\V1\Boiler\Model\BoilerModelRepositoryInterface;
use App\Interfaces\V1\Boiler\Type\BoilerTypeRepositoryInterface;
use App\Interfaces\V1\Engineer\EngineerRepositoryInterface;
use App\Interfaces\V1\GassSafetyRegistration\GassSafetyRegistrationRepositoryInterface;
use App\Interfaces\V1\NICEIC\NICEICRepositoryInterface;
use App\Interfaces\V1\NQR\NVQRepositoryInterface;
use App\Interfaces\V1\Property\Job\PropertyJobRepositoryInterface;
use App\Interfaces\V1\Property\PropertyRepositoryInterface;
use App\Interfaces\V1\Property\Type\PropertyTypeRepositoryInterface;
use App\Interfaces\V1\Role\RoleRepositoryInterface;
use App\Interfaces\V1\Service\ServiceRepositoryInterface;
use App\Repositories\V1\Address\AddressRepository;
use App\Repositories\V1\Address\City\CityRepository;
use App\Repositories\V1\Address\Country\CountryRepository;
use App\Repositories\V1\Address\State\StateRepository;
use App\Repositories\V1\Address\Zip\ZipRepository;
use App\Repositories\V1\Auth\ForgetPasswordRepository;
use App\Repositories\V1\Auth\OTPRepository;
use App\Repositories\V1\Auth\PasswordRepository;
use App\Repositories\V1\Auth\UserRepository;
use App\Repositories\V1\BankAccount\BankAccountRepository;
use App\Repositories\V1\Boiler\Model\BoilerModelRepository;
use App\Repositories\V1\Boiler\Type\BoilerTypeRepository;
use App\Repositories\V1\Engineer\EngineerRepository;
use App\Repositories\V1\GassSafetyRegistration\GassSafetyRegistrationRepository;
use App\Repositories\V1\NICEIC\NICEICRepository;
use App\Repositories\V1\NQR\NVQRepository;
use App\Repositories\V1\Property\Job\PropertyJobRepository;
use App\Repositories\V1\Property\PropertyRepository;
use App\Repositories\V1\Property\Type\PropertyTypeRepository;
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

        // property
        $this->app->bind(PropertyRepositoryInterface::class, PropertyRepository::class);
        $this->app->bind(PropertyTypeRepositoryInterface::class, PropertyTypeRepository::class);

        // property job
        $this->app->bind(PropertyJobRepositoryInterface::class, PropertyJobRepository::class);

        //Address
        $this->app->bind(AddressRepositoryInterface::class, AddressRepository::class);
        $this->app->bind(CountryRepositoryInterface::class, CountryRepository::class);
        $this->app->bind(StateRepositoryInterface::class, StateRepository::class);
        $this->app->bind(CityRepositoryInterface::class, CityRepository::class);
        $this->app->bind(ZipRepositoryInterface::class, ZipRepository::class);

        // boiler
        $this->app->bind(BoilerTypeRepositoryInterface::class, BoilerTypeRepository::class);
        $this->app->bind(BoilerModelRepositoryInterface::class, BoilerModelRepository::class);

        // engineer
        $this->app->bind(EngineerRepositoryInterface::class, EngineerRepository::class);

        // GSR
        $this->app->bind(GassSafetyRegistrationRepositoryInterface::class, GassSafetyRegistrationRepository::class);

        // NICEIC
        $this->app->bind(NICEICRepositoryInterface::class, NICEICRepository::class);

        // NVQ
        $this->app->bind(NVQRepositoryInterface::class, NVQRepository::class);

        // Bank accoutn
        $this->app->bind(BankAccountRepositoryInterface::class, BankAccountRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
