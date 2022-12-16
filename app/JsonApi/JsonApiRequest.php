<?php

namespace App\JsonApi;

use Closure;
use Illuminate\Http\Request;

class JsonApiRequest
{
    public function isJsonApi(): Closure
    {
        return function() {
            /** @var Request $this */
            if ($this->header('accept') === 'application/vnd.api+json') {
                return true;
            }

            return $this->header('content-type') === 'application/vnd.api+json';
        };
    }

    public function validatedData(): Closure
    {
        return function () {
            /** @var Request $this */
            return $this->validated()['data'];
        };
    }

    public function getAttributes(): Closure
    {
        return function () {
            /** @var Request $this */
            return $this->validatedData()['attributes'];
        };
    }

    public function getRelationshipId(): Closure
    {
        return function ($relation) {
            /** @var Request $this */
            return $this->validatedData()['relationships'][$relation]['data']['id'];
        };
    }

    public function hasRelationships(): Closure
    {
        return function () {
            /** @var Request $this */
            return isset($this->validatedData()['relationships']);
        };
    }

    public function hasRelationship(): Closure
    {
        return function ($relation) {
            /** @var Request $this */
            return $this->hasRelationships()
                && isset($this->validatedData()['relationships'][$relation]);
        };
    }
}
