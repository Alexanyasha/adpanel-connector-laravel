<?php

namespace DesignCoda\AdpanelConnector;

use DesignCoda\AdpanelConnector\Rules\TokenSetRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AdpanelConnectorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            'token' => [
                'required',
                'string',
                new TokenSetRule,
                'in:' . config('adpanel_connector.auth_token'),
            ],
            'from' => 'sometimes|date',
            'to' => 'sometimes|date|after_or_equal:from',
            'order_by' => 'sometimes|string',
            'desc' => 'sometimes|boolean',
        ];
    }

    public function messages()
    {
        return [
            'token.required' => trans('adpanel_connector::main.validation.required', ['attribute' => trans('adpanel_connector::main.label.token')]),
            'token.string' => trans('adpanel_connector::main.validation.string', ['attribute' => trans('adpanel_connector::main.label.token')]),
            'token.in' => trans('adpanel_connector::main.validation.in', ['attribute' => trans('adpanel_connector::main.label.token')]),
            'from.date' => trans('adpanel_connector::main.validation.date', ['attribute' => trans('adpanel_connector::main.label.from')]),
            'to.date' => trans('adpanel_connector::main.validation.date', ['attribute' => trans('adpanel_connector::main.label.to')]),
            'to.after_or_equal' => trans('adpanel_connector::main.validation.after_or_equal', 
                [
                    'attribute' => trans('adpanel_connector::main.label.to'), 
                    'date' => trans('adpanel_connector::main.label.from'),
                ]
            ),
            'order_by.string' => trans('adpanel_connector::main.validation.string', ['attribute' => trans('adpanel_connector::main.label.order_by')]),
            'desc.boolean' => trans('adpanel_connector::main.validation.boolean', ['attribute' => trans('adpanel_connector::main.label.desc')]),
        ];
    }

    /**
     * Return validation errors as json response
     *
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        $response = [
            'status' => 'failure',
            'status_code' => 400,
            'message' => 'Bad Request',
            'errors' => $validator->errors(),
        ];

        throw new HttpResponseException(response()->json($response, 400, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
        JSON_UNESCAPED_UNICODE));
    }
}
