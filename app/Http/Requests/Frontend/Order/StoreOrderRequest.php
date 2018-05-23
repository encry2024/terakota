<?php

namespace App\Http\Requests\Frontend\Order;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('store order');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'required',
            'dining_id' => 'required',
            'order_type' => 'required',
            'product_id' => 'required',
            'quantity' => 'required'
        ];
    }
}
