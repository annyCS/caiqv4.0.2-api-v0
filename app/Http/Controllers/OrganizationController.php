<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organization;

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
}
