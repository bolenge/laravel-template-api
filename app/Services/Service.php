<?php
namespace App\Services;

use Illuminate\Support\Facades\Log;
use App\Http\Requests\ValidatorRequest;
use Illuminate\Database\Eloquent\Model;

class Service
{
  /**
   * Response object
   * @var array
   */
  protected $responseObject = [
      'success' => false,
      'message' => '',
      'results' => null
  ];

  /**
   * Checks if the request failed and returns the errors tracked
   * @param ValidatorRequest $request
   * @return object
   */
  public function requestFailed(ValidatorRequest $request)
  {
      if ($request->errors()) {
        $this->responseObject['message'] = $request->errors();
        return response()->json($this->responseObject, 422);
      }
  }

  /**
   * Send the response with json object
   * @param mixed $results The data to send
   * @param string $message
   * @param string|int $status
   * @param bool $success
   */
  public function responseJson($results = null, bool $success = false, string $message =  '', $status = 200)
  {
      $this->responseObject['success'] = $success;
      $this->responseObject['message'] = $message;
      $this->responseObject['results'] = $results;

      return response()->json($this->responseObject, $status);
  }

  /**
   * When an internal error catche
   * @param $exception
   * @return object
   */
  public function respondInternalErrorCatch($exception)
  {
    Log::info("Internal error", [$exception]);

    return $this->responseJson(null, false, 'Une erreur serveur est survenue, ressayez svp.', 500);
  }

  /**
   * @param string $path
   * @param Model $model
   * @param string $fieldName
   */
  public function storeFile($path, Model $model, string $fieldName)
  {
      $name = null;

      if (request($fieldName)) {
          $name = request($fieldName)->store($path, 'public');
          $name = str_replace($path.'/', '', $name);
          $model->update([
              $fieldName => $name
          ]);
      }

      return $name;
  }
}
