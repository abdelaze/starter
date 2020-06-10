<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class OfferRequest extends FormRequest
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

            return  [

//
               // 'name_en' => 'required|max:100|unique:offers,name_en',
                'name_en' => [
                    'required',
                    Rule::unique('offers', 'name_en')->ignore($this->offer_id)
                ],
                'name_ar' => [
                    'required',
                    Rule::unique('offers', 'name_ar')->ignore($this->offer_id)
                ],
               // 'name_ar' => 'required|max:100|unique:offers,name_ar',
                'price' => 'required|numeric',
                'details' => 'required',
                'photo' => 'required|mimes:jpeg,bmp,png',
            ];

    }
    public function messages () {
        return [
            'name_en.required' => __('messages.offer name required'),
            'name_ar.required' => __('messages.offer name required'),
            'name_en.unique' => __('messages.offer name must be unique'),
            'name_ar.unique' => __('messages.offer name must be unique'),
            'price.numeric' => __('messages.offer price numeric'),
            'price.required' => __('messages.offer price required'),
            'details.required' => __('messages.offer details required'),
        ];
    }
}
