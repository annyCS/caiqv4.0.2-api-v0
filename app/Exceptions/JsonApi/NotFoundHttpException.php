<?php

namespace App\Exceptions\JsonApi;

use Exception;

class NotFoundHttpException extends Exception
{
    public function render($request)
    {
        $id = $request->input('data.id');
        $type = $request->input('data.type');

        return response()->json([
            'errors' => [
                [
                    'title' => 'Not Found',
                    'detail' => "No records found with the id '{$id}' in the '{$type}' resource.",
                    'status' => '404'
                ]
            ]
        ], 404);
    }
}
