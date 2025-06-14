<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Api\V1\Controller;
use App\Http\Requests\Api\V1\Auth\EmployRegistrationRequest;
use App\Http\Requests\Api\V1\Auth\EngineerRegistrationRequest;
use App\Http\Resources\Api\V1\Auth\LoginResponce;
use App\Http\Resources\Api\V1\Auth\RegisterUserResource;
use App\Services\Api\V1\Auth\AuthService;
use App\Http\Requests\Api\V1\Auth\LoginRequest;
use App\Http\Requests\Api\V1\Auth\PlumberRegistrationRequest;
use App\Http\Requests\Api\V1\Auth\RegisterRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    protected AuthService $authService;

    /**
     * Constructor for initializing the class with the AuthService dependency.
     *
     * @param AuthService $authService The authentication service instance used for handling authentication-related operations.
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }



    /**
     * Handles the user registration process by validating the request and delegating
     * the registration logic to the AuthService.
     *
     * This method first validates the incoming registration data using the provided
     * RegisterRequest. If validation passes, it calls the AuthService to register
     * the user and generate a JWT token. Upon success, it returns a success response
     * with the generated token. If an error occurs during the registration process,
     * it returns an error response with the appropriate message.
     *
     * @param RegisterRequest $request The validated registration request containing user data:
     *                                 - 'name' (string): The user's full name.
     *                                 - 'email' (string): The user's email address.
     *                                 - 'password' (string): The user's password.
     *
     * @return \Illuminate\Http\JsonResponse A JSON response with the registration result:
     *                                      - On success: Returns the JWT token and a success message.
     *                                      - On failure: Returns the error message.
     *
     * @throws Exception If any error occurs during user registration.
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            $validatedData = $request->validated();

            $response = $this->authService->register($validatedData);

            return $this->success(201, 'Registration Successful', new RegisterUserResource($response));
        } catch (Exception $e) {
            Log::error('AuthController::register', ['error' => $e->getMessage()]);
            return $this->error(500, 'Server Error', $e->getMessage());
        }
    }

    /**
     * employRegistration
     * @param \App\Http\Requests\Api\V1\Auth\EmployRegistrationRequest $employRegistrationRequest
     * @return JsonResponse
     */
    public function employRegistration(EmployRegistrationRequest $employRegistrationRequest)
    {
        try {
            $validatedData = $employRegistrationRequest->validated();

            $response = $this->authService->bothRegistration($validatedData);
            return $this->success(201, 'engineer and plumber created', $response);
        } catch (Exception $e) {
            Log::error('AuthController::employRegistration', ['error' => $e->getMessage()]);
            return $this->error(500, 'Server Error', $e->getMessage());
        }
    }

    /**
     * engineerRegistration
     * @param \App\Http\Requests\Api\V1\Auth\EngineerRegistrationRequest $engineerRegistrationRequest
     * @return JsonResponse
     */
    public function engineerRegistration(EngineerRegistrationRequest $engineerRegistrationRequest)
    {
        try {
            $validatedData = $engineerRegistrationRequest->validated();

            $response = $this->authService->engineerRegistration($validatedData);
            return $this->success(201, 'Engineer created', $response);
        } catch (Exception $e) {
            Log::error('AuthController::engineerRegistration', ['error' => $e->getMessage()]);
            return $this->error(500, 'Server Error', $e->getMessage());
        }
    }

    /**
     * plumberRegistration
     * @param \App\Http\Requests\Api\V1\Auth\PlumberRegistrationRequest $plumberRegistrationRequest
     * @return JsonResponse
     */
    public function plumberRegistration(PlumberRegistrationRequest $plumberRegistrationRequest)
    {
        try {
            $validatedData = $plumberRegistrationRequest->validated();

            $response = $this->authService->plumberRegistration($validatedData);
            return $this->success(201, 'plumber created', $response);
        } catch (Exception $e) {
            Log::error('AuthController::plumberRegistration', ['error' => $e->getMessage()]);
            return $this->error(500, 'Server Error', $e->getMessage());
        }
    }



    /**
     * Handles the user registration process.
     *
     * Validates the incoming registration request data, calls the AuthService to register the user,
     * and returns a JSON response with the result of the registration attempt.
     *
     * @param RegisterRequest $request The validated registration request containing user data.
     *
     * @return JsonResponse The JSON response indicating the success or failure of the registration.
     */
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $validatedData = $request->validated();

            $response = $this->authService->login($validatedData);

            return $this->success(200, 'Login Successfully', new LoginResponce($response));
        } catch (Exception $e) {
            Log::error('AuthController::login', ['error' => $e->getMessage()]);
            return $this->error(500, 'Server Error', $e->getMessage());
        }
    }




    /**
     * Handles user logout by terminating the user's session.
     *
     * Calls the AuthService to perform the logout operation, and returns a JSON response
     * indicating the success or failure of the logout attempt.
     *
     * @return JsonResponse The JSON response indicating the success or failure of the logout.
     */
    public function logout(): JsonResponse
    {
        try {
            $this->authService->logout();
            return $this->success(200, 'Logout Successfully');
        } catch (Exception $e) {
            Log::error('AuthController::logout', ['error' => $e->getMessage()]);
            return $this->error(500, 'Server Error', $e->getMessage());
        }
    }




    /**
     * Refreshes the authentication token for the user.
     *
     * Retrieves the current token, refreshes it, and returns a new token in the response.
     * If the refresh operation fails, an error message is logged and a failure response is returned.
     *
     * @return JsonResponse The JSON response containing the updated token or an error message.
     */
    public function refresh(): JsonResponse
    {
        try {
            $token = JWTAuth::refresh(JWTAuth::getToken());
            return $this->success(200, 'Token Updated', ['token' => $token]);
        } catch (Exception $e) {
            Log::error('AuthController::refresh', ['error' => $e->getMessage()]);
            return $this->error(500, 'server Error', $e->getMessage());
        }
    }
}
