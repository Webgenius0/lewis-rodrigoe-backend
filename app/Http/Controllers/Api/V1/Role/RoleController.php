<?php

namespace App\Http\Controllers\Api\V1\Role;

use App\Http\Controllers\Api\V1\Controller;
use App\Services\Api\V1\Role\RoleService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{
    private RoleService $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    /**
     * index
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $data = $this->roleService->getList();
            return $this->success(200, 'role list', $data);
        } catch (Exception $e) {
            Log::error('RoleController::index', ['error' => $e->getMessage()]);
            return $this->error(500, 'server error', $e->getMessage());
        }
    }
}
