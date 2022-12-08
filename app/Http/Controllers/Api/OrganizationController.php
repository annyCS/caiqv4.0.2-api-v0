<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\User;

class OrganizationController extends Controller
{
    public function organizations()
    {
        $organizations = Organization::all();

        return response()->json($organizations);
    }

    public function organizationDetail($id)
    {
        $organization = Organization::where('id', $id)
            ->firstOrFail();

        return response()->json($organization);
    }

    public function listUsers($id)
    {
        $users = User::where('organization_id', $id)
            ->get();

        return response()->json($users);
    }
}
