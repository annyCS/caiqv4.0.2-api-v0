<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\User;
use App\Models\Questionnaire;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Cache;

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

    public function listQuestionnairesByOrganization($id)
    {
        $questionnaires = Cache::rememberForever('list_questionnaires_by_organizationId_' . $id, function () use ($id) {
            return Questionnaire::query()
                ->where('organization_id', '=', $id)
                ->get();
        });

        return response()->json($questionnaires);
    }
}
