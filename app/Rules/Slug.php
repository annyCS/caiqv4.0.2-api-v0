<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Slug implements Rule
{
    protected string $message;

    public function passes($attribute, $value): bool
    {
        if($this->hasUnderscores($value)) {
            $this->message = trans('validation.no_underscores');
            return false;
        }

        if($this->startsWithDashes($value)) {
            $this->message = trans('validation.no_starting_dashes');
            return false;
        }

        if($this->endsWithDashes($value)) {
            $this->message = trans('validation.no_ending_dashes');
            return false;
        }

        return true;
    }

    public function message(): string
    {
        return $this->message;
    }

    /**
     * @param $value
     * @return false|int
     */
    protected function hasUnderscores($value)
    {
        return preg_match('/_/', $value);
    }

    /**
     * @param $value
     * @return false|int
     */
    protected function startsWithDashes($value)
    {
        return preg_match('/^-/', $value);
    }

    /**
     * @param $value
     * @return false|int
     */
    protected function endsWithDashes($value)
    {
        return preg_match('/-$/', $value);
    }
}
