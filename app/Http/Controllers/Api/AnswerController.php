<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Questionnaire;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Cache;

class AnswerController extends Controller
{
    public function listAnswers($id)
    {
        $questionnaires = Cache::rememberForever('list_questions_by_questionnaireId_' . $id, function () use ($id) {
            return Question::query()
                ->where('organization_id', '=', $id)
                ->get();
        });

        return response()->json($questionnaires);
    }
}
