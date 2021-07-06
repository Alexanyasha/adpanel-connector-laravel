<?php

namespace DesignCoda\AdpanelConnector\Rules;

use Illuminate\Contracts\Validation\Rule;

class TokenSetRule implements Rule
{
    
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return (config('adpanel_connector.auth_token') !== null);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('adpanel_connector::main.validation.set_token');
    }
}
