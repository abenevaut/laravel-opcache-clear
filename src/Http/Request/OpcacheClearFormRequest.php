<?php namespace CVEPDB\Opcache\Clear\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class OpcacheClearFormRequest
 * @package CVEPDB\Opcache\Clear\Http\Request
 */
class OpcacheClearFormRequest extends FormRequest
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
		$rules = [
			'token' => 'required',
		];

		return $rules;
	}
}
