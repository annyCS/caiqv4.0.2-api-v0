<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\User;
use App\Models\Questionnaire;

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

    public function listQuestionnaires($id)
    {
        // $questionnaires = Organization::where('id', $id)->questionnaires()->get();
        /*$questionnaires = Organization::where('id', $id)
            ->with(['questionnaires' => function ($query) {
                $query->groupBy('questionnaires.id');
            }, 'questionnaires.questions'])
            ->get();*/

        $list = Cache::rememberForever('list_questionnaires_by_organizationId_' . $id, function () use ($id) {
            return Questionnaire::select('id','name', 'description', 'created_at', 'created_by', 'lastupdate_at','lastupdate_by', 'status')           
                ->with(['users' => function ($query) {
                    $query->leftjoin('modules','modules.id', '=', 'pivot_master_module_subject.module_id')
                    ->groupBy('subjects.id')->orderby('modules.num_module');
                }, 'subjects.modules' => function ($query) use ($id) {
                    $query->orderBy('modules.num_module')->where('pivot_master_module_subject.master_id', '=', $id);
                }])
                ->firstOrFail();
        });




        $questionnaires = Questionnaire::query()
            ->with(['organizations' => function ($query) {
                    $query->where('organizations.id', '=', 'questionn_org_question.organization_id');
                }
            ])->get();

        return response()->json($questionnaires);
    }
}
