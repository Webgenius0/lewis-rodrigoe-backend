<?php

namespace App\Services\Api\V1\Auth;

use App\Helpers\Helper;
use App\Interfaces\V1\Auth\OTPRepositoryInterface;
use App\Interfaces\V1\Auth\UserRepositoryInterface;
use App\Interfaces\V1\BankAccount\BankAccountRepositoryInterface;
use App\Interfaces\V1\DrivingLicence\DrivingLicenceRepositoryInterface;
use App\Interfaces\V1\Engineer\EngineerRepositoryInterface;
use App\Interfaces\V1\GassSafetyRegistration\GassSafetyRegistrationRepositoryInterface;
use App\Interfaces\V1\NICEIC\NICEICRepositoryInterface;
use App\Interfaces\V1\NQR\NVQRepositoryInterface;
use App\Models\User;
use App\Repositories\V1\Address\AddressRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthService
{
    private UserRepositoryInterface $userRepository;
    private OTPRepositoryInterface $otpRepository;
    private EngineerRepositoryInterface $engineerRepository;
    private GassSafetyRegistrationRepositoryInterface $gassSafetyRegistrationRepository;
    private NICEICRepositoryInterface $niceicRepository;
    private NVQRepositoryInterface $nvqRepositoy;
    private DrivingLicenceRepositoryInterface $drivingLicenceRepository;
    private BankAccountRepositoryInterface $bankAccountRepository;


    /**
     * Constructor for initializing the class with UserRepository and OTPRepository dependencies.
     *
     * @param UserRepositoryInterface $userRepository The repository used for user-related data operations.
     * @param OTPRepositoryInterface $otpRepository The repository used for OTP-related data operations.
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        OTPRepositoryInterface $otpRepository,
        EngineerRepositoryInterface $engineerRepository,
        GassSafetyRegistrationRepositoryInterface $gassSafetyRegistrationRepository,
        NICEICRepositoryInterface $niceicRepository,
        NVQRepositoryInterface $nvqRepositoy,
        DrivingLicenceRepositoryInterface $drivingLicenceRepository,
        BankAccountRepositoryInterface $bankAccountRepository,
    ) {
        $this->userRepository                   = $userRepository;
        $this->otpRepository                    = $otpRepository;
        $this->engineerRepository               = $engineerRepository;
        $this->gassSafetyRegistrationRepository = $gassSafetyRegistrationRepository;
        $this->niceicRepository                 = $niceicRepository;
        $this->nvqRepositoy                     = $nvqRepositoy;
        $this->drivingLicenceRepository         = $drivingLicenceRepository;
        $this->bankAccountRepository            = $bankAccountRepository;
    }

    /**
     * Registers a new user and generates an authentication token.
     *
     * Creates a user using the provided credentials, sends an OTP to the user's email,
     * and attempts to generate a JWT token. If successful, it returns the token and user details.
     * If an error occurs, it rolls back the transaction and logs the error.
     *
     * @param array $credentials The user's registration details, including email and password.
     *
     * @return array The registration result, including the generated token, user's role, OTP status, and verification status.
     */
    public function register(array $credentials, $role = 2): array
    {
        try {
            DB::beginTransaction();
            $avatar = null;
            if (isset($credentials['avatar'])) {
                $avatar = Helper::uploadFile($credentials['avatar'], 'avatar');
            }
            $user = $this->userRepository->createUser($credentials, $avatar, $role);
            $otp = $this->otpRepository->sendOtp($user, 'email');

            $token = $token = JWTAuth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']]);

            if (!$token) {
                throw new Exception('Token generation failed.', 500);
            }
            DB::commit();
            $user->load(['profile' => function ($query) {
                $query->select('id', 'user_id');
            }, 'role']);
            return ['token' => $token, 'user' => $user, 'verify' => false];
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('AuthService::register', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * engineerRegistration
     * @param mixed $data
     * @return array
     */
    public function engineerRegistration($data): array
    {
        try {
            DB::beginTransaction();
            $response = $this->register($data, 4);
            // finding the user
            $userId = $response['user']['id'];
            $user = User::findOrFail($userId);
            $addressRepository = new AddressRepository();
            // creating address
            $address = $addressRepository->createAddress($data);
            // storing engineer data
            $engineer = $this->engineerRepository->createEngineer($data, $address->id, $user);
            //gas
            $gas_cart_front = null;
            $gas_cart_back = null;
            if (isset($data['gas_cart_front'])) {
                $gas_cart_front = Helper::uploadFile($data['gas_cart_front'], 'gas');
            }
            if (isset($data['gas_cart_back'])) {
                $gas_cart_back = Helper::uploadFile($data['gas_cart_back'], 'gas');
            }
            $gas = $this->gassSafetyRegistrationRepository->createGSR($data, $gas_cart_front, $gas_cart_back, $user);
            // niceic
            $nic_eic_cart_front = null;
            $nic_eic_card_back = null;
            if (isset($data['nic_eic_cart_front'])) {
                $nic_eic_cart_front = Helper::uploadFile($data['nic_eic_cart_front'], 'ncieci');
            }
            if (isset($data['nic_eic_card_back'])) {
                $nic_eic_card_back = Helper::uploadFile($data['nic_eic_card_back'], 'ncieci');
            }
            $niceic = $this->niceicRepository->createNICEIC($data, $nic_eic_cart_front, $nic_eic_card_back, $user);
            // nvq
            $nvq_level_one = null;
            $nvq_level_two = null;
            if (isset($data['nvq_level_one'])) {
                $nvq_level_one = Helper::uploadFile($data['nvq_level_one'], 'nvq');
            }
            if (isset($data['nvq_level_two'])) {
                $nvq_level_two = Helper::uploadFile($data['nvq_level_two'], 'nvq');
            }
            $nvq = $this->nvqRepositoy->createNVQ($data, $user, $nvq_level_one, $nvq_level_two);
            // driving licence
            $driving_licence_cart_front = null;
            $driving_licence_card_back = null;
            if (isset($data['driving_licence_cart_front'])) {
                $driving_licence_cart_front = Helper::uploadFile($data['driving_licence_cart_front'], 'drivingLicence');
            }
            if (isset($data['driving_licence_card_back'])) {
                $driving_licence_card_back = Helper::uploadFile($data['driving_licence_card_back'], 'drivingLicence');
            }
            $drigingLicence = $this->drivingLicenceRepository->createDrivingLicence($data, $driving_licence_cart_front, $driving_licence_card_back, $user);
            // bank account
            $bankAccount = $this->bankAccountRepository->createBankAccount($data, $user);
            DB::commit();
            return $response;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('AuthService::register', ['error' => $e->getMessage()]);
            throw $e;
        }
    }



    /**
     * Authenticates a user and generates a JWT token.
     *
     * Validates the user's credentials, generates a JWT token, and returns the token along with the user's role
     * and email verification status. If authentication or token generation fails, an exception is thrown.
     *
     * @param array $credentials The user's login details, including email and password.
     *
     * @return array The authentication result, including the generated token, user's role, and email verification status.
     */
    public function login(array $credentials): array
    {
        try {
            $user = $this->userRepository->login($credentials);

            $token = JWTAuth::fromUser($user);

            if (!$token) {
                throw new Exception('Token generation failed.');
            }

            $verify = false;
            if ($user->email_verified_at) {
                $verify = true;
            }

            $user->load(['profile' => function ($query) {
                $query->select('id', 'user_id');
            }, 'role']);

            return ['token' => $token, 'user' => $user, 'verify' => $verify];
        } catch (Exception $e) {
            Log::error('AuthService::login', ['error' => $e->getMessage()]);
            throw $e;
        }
    }



    /**
     * Logs out the user by invalidating the current JWT token.
     *
     * Retrieves the current authentication token and invalidates it, effectively logging the user out.
     * If an error occurs during the process, it logs the error and throws an exception.
     *
     * @return void
     */
    public function logout(): void
    {
        try {
            $token = JWTAuth::getToken();
            JWTAuth::invalidate($token);
        } catch (Exception $e) {
            Log::error('AuthService::logout', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
