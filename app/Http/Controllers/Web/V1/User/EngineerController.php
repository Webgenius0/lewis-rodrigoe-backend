<?php

namespace App\Http\Controllers\Web\V1\User;

use App\Http\Controllers\Web\V1\Controller;
use App\Services\Web\V1\User\UserService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EngineerController extends Controller
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
            $users = $this->userService->getEngineerList();
            $compact = [
                'users' => $users,
            ];
            return view('backend.layouts.user.engineer.index', $compact);
        }catch (Exception $e) {
            Log::error('EngineerController:index',  [$e->getMessage()]);
            return view('errors.500');
        }
    }
}
