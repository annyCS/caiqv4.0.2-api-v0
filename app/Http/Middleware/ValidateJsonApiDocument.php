<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ValidateJsonApiDocument
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->isMethod('POST') || $request->isMethod('PATCH')) {
            $request->validate([
                'data' => ['required', 'array'],
                'data.type' => ['required', 'string'],
                'data.attributes' => [
                    Rule::requiredIf(
                        ! Str::of(request()->url())->contains('relationships')
                    ),
                    'array'
                ],
            ]);
        }

        if ($request->isMethod('PATCH')) {
            $request->validate([
                'data.id' => ['required', 'string']
            ]);
        }

        return $next($request);
    }
}
