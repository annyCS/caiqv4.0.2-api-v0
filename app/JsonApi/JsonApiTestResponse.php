<?php

namespace App\JsonApi;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Testing\TestResponse;
use PHPUnit\Framework\Assert as PHPUnit;
use PHPUnit\Framework\ExpectationFailedException;

class JsonApiTestResponse
{
    public function assertJsonApiError(): Closure
    {
        return function ($title = null, $detail = null, $status = null) {
            /** @var TestResponse $this */

            try {
                $this->assertJsonStructure([
                    'errors' => [
                        '*' => ['title', 'detail']
                    ]
                ]);
            } catch (ExpectationFailedException $e) {
                PHPUnit::fail(
                    "Error objects MUST be returned as an array keyed by errors in the top level of a JSON:API document"
                    .PHP_EOL.PHP_EOL.
                    $e->getMessage()
                );
            }

            $title && $this->assertJsonFragment(['title' => $title]);
            $detail && $this->assertJsonFragment(['detail' => $detail]);
            $status && $this->assertStatus((int) $status)
                ->assertJsonFragment(['status' => $status]);

            return $this;
        };
    }

    public function assertJsonApiValidationErrors(): Closure
    {
        return function ($attribute) {
            /** @var TestResponse $this */

            $pointer = "/data/attributes/{$attribute}";

            if (Str::of($attribute)->startsWith('data')) {
                $pointer = "/".str_replace('.', '/', $attribute);
            } elseif (Str::of($attribute)->startsWith('relationships')) {
                $pointer = "/data/".str_replace('.', '/', $attribute).'/data/id';
            }

            try {
                $this->assertJsonFragment([
                    'source' => ['pointer' => $pointer]
                ]);
            } catch (ExpectationFailedException $e) {
                PHPUnit::fail(
                    "Failed to find a JSON:API validation error for key: '{$attribute}'"
                    .PHP_EOL.PHP_EOL.
                    $e->getMessage()
                );
            }

            try {
                $this->assertJsonStructure([
                    'errors' => [
                        ['title', 'detail', 'source' => ['pointer']]
                    ]
                ]);
            } catch (ExpectationFailedException $e) {
                PHPUnit::fail(
                    "Failed to find a valid JSON:API error response"
                    .PHP_EOL.PHP_EOL.
                    $e->getMessage()
                );
            }

            return $this->assertHeader(
                'content-type', 'application/vnd.api+json'
            )->assertStatus(422);
        };
    }

    public function assertJsonApiResource(): Closure
    {
        return function ($model, $attributes) {
            /** @var TestResponse $this */

            return $this->assertJson([
                'data' => [
                    'type' => $model->getResourceType(),
                    'id' => (string) $model->getRouteKey(),
                    'attributes' => $attributes,
                    'links' => [
                        'self' => route('api'.$model->getResourceType().'.show', $model)
                    ]
                ]
            ])->assertHeader(
                'Location',
                route('api'.$model->getResourceType().'.show', $model)
            );
        };
    }

    public function assertJsonApiRelationshipLinks(): Closure
    {
        return function($model, $relations) {
            /** @var TestResponse $this */
            foreach($relations as $relation) {
                $this->assertJson([
                    'data' => [
                        'relationships' => [
                            $relation => [
                                'links' => [
                                    'self' => route("api{$model->getResourceType()}.relationships.{$relation}", $model),
                                    'related' => route("api{$model->getResourceType()}.{$relation}", $model)
                                ]
                            ]
                        ]
                    ]
                ]);
            }

            return $this;
        };
    }

    public function assertJsonApiResourceCollection(): Closure
    {
        return function ($models, $attributesKeys) {
            /** @var TestResponse $this */

            $this->assertJsonStructure([
                'data' => [
                    '*' => [
                        'attributes' => $attributesKeys
                    ]
                ]
            ]);

            foreach ($models as $model) {
                $this->assertJsonFragment([
                    'type' => $model->getResourceType(),
                    'id' => (string) $model->getRouteKey(),
                    'links' => [
                        'self' => route('api'.$model->getResourceType().'.show', $model)
                    ]
                ]);
            }

            return $this;
        };
    }
}
