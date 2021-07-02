<?php

namespace DesignCoda\AdpanelConnector;

use Illuminate\Foundation\Http\FormRequest;

class AdpanelConnectorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // if (! backpack_auth()->check() || ! request()->has('id')) {
        //     return false;
        // }
        
        // $account = ApiAccountDetailed::find(request()->id);

        // if($account) {
        //     return ((! $account->main_report) && backpack_user()->can('update', $account));
        // }
        
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'id' => 'required|integer',       
        ];
    }

    public function messages()
    {
        return [
            // 'id.required' => trans('validation.required', ['attribute' => trans('backpack::fields.id')]),
            // 'id.integer' => trans('validation.integer', ['attribute' => trans('backpack::fields.id')]),
        ];
    }
}
