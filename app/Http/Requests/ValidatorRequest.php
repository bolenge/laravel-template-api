<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;


class ValidatorRequest extends FormRequest {

  const NULLABLE_ARRAY          = 'nullable|array';
  const REQUIRED_DATE           = 'required|date';
  const NULLABLE_DATE           = 'nullable|date';
  const REQUIRED_EMAIL          = 'required|string|email';
  const NULLABLE_STRING         = 'nullable|string';
  const REQUIRED_STRING         = 'required|string';
  const NULLABLE_BOOLEAN        = 'nullable|boolean';
  const REQUIRED_NUMERIC        = 'required|numeric';
  const NULLABLE_NUMERIC        = 'nullable|numeric';
  const SOMETIMES_STRING        = 'sometimes|string';
  const SOMETIMES_NUMERIC       = 'sometimes|numeric';
  const NULLABLE_STRING_MAX_255 = 'nullable|string|max:255';

  /**
   * Le message d'erreur
   * @var string
   */
  protected $errors = '';

  /**
   * @var bool
   */
  protected $failed = false;

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
   * Handle a failed validation attempt.
   *
   * @param  \Illuminate\Contracts\Validation\Validator  $validator
   * @return void
   *
   * @throws \Illuminate\Validation\ValidationException
   */
  protected function failedValidation(Validator $validator)
  {
    $this->failed = true;
    $this->errors = collect($validator->errors()->all())->join(', ');
  }

  public function handleValidationException(Validator $validator)
  {
    $this->failedValidation($validator);
  }

  /**
   * Returns true if there are errors in the validation
   * @return bool
   */
  public function failed()
  {
    return $this->failed;
  }

  /**
   * Returns validation errors
   * @return string
   */
  public function errors()
  {
    return $this->errors;
  }

  public function setErrors($errors)
  {
    $this->errors = $errors;
  }
}