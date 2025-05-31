<?php

namespace App\Http\Controllers\Web\V1\User;

use App\Http\Controllers\Web\V1\Controller;
use App\Services\Web\V1\User\UserService;
use Exception;
use Illuminate\Contracts\View\View;
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


    /**
     * index
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        try {
            $users = $this->userService->getClientList();
            $compact = [
                'users' => $users,
            ];
            return view('backend.layouts.user.client.index', $compact);
        } catch (Exception $e) {
            Log::error('ClientController:index',  [$e->getMessage()]);
            return view('errors.500');
        }
    }
}
