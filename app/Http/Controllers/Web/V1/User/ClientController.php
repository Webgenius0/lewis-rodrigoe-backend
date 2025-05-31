<?php

namespace App\Http\Controllers\Web\V1\User;

use App\Http\Controllers\Web\V1\Controller;
use App\Services\Web\V1\User\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ClientController extends Controller
{
    /**
     * userService
     * @var UserService
     */
    private UserService $userService;

    /**
     * __construct
     * @param \App\Services\Web\V1\User\UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    public function index()
    {
        try {
            $users = $this->userService->getClientList();
            
        }catch (Exception $e) {
            Log::error('ClientController:index',  [$e->getMessage()]);
        }
    }
}
