<?php


namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class TransactionStoreRequest extends FormRequest
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
			'start_date'       => 'required|date',
			'end_date'         => 'required|date',
			'first_name'	   => 'required|string',
			'last_name'	       => 'required|string',
			'email'	           => 'required|string',
			'telnumber'        => 'required|string',
			'address1'         => 'required|string',
			'address2'         => 'required|string',
			'city'      	   => 'required|string',
			'country'     	   => 'required|string',
			'postcode'         => 'required|string',
			'product_name'     => 'required|string',
			'cost'      	   => 'required|string',
			'currency'         => 'required|string',
			'transaction_date' => 'required|string',
		];
	}
}