<?php


namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\QueryException;

class Responder
{
    private string $message = "Error occurred";
    private int $status = JsonResponse::HTTP_INTERNAL_SERVER_ERROR;
    private array $errors = [];
    private ?array $model = null;

    public function exceptionResponse(\Exception $e): Response
    {
        $this->errors = ['error' => $e->getMessage()];

        return $this->respond();
    }

    public function queryExceptionResponse(QueryException $e): Response
    {
        $this->message = 'Database error';
        $this->status = JsonResponse::HTTP_INTERNAL_SERVER_ERROR;
        $this->errors = ['error' => $e->getMessage()];

        return $this->respond();
    }

    public function authenticationExceptionResponse(AuthenticationException $e): Response
    {
        $this->message = 'Authentication exception';
        $this->status = JsonResponse::HTTP_UNAUTHORIZED;
        $this->errors = ['error' => $e->getMessage()];

        return $this->respond();
    }

    public function notFoundResponse(NotFoundHttpException $e): Response
    {
        $modelName = $this->getModelName($e->getMessage());
        $this->message = 'Cant find requested ' . $modelName;
        $this->status = $e->getStatusCode() ?? JsonResponse::HTTP_NOT_FOUND;
        $this->errors = [$modelName => $e->getMessage()];

        return $this->respond();
    }

    public function validationResponse(ValidationException $e): Response
    {
        $this->message = "Validation error";
        $this->status = JsonResponse::HTTP_UNPROCESSABLE_ENTITY;
        $this->errors = collect($e->errors())->mapWithKeys(function ($messages, $field) {
            return [$field => collect($messages)->map(function ($message){
                return ctype_digit($message) ? (int)$message : $message;
            })->toArray()];
        })->toArray();

        return $this->respond();
    }

    private function respond(): Response
    {
        return response()->json(
            [
                'model' => $this->model,
                'status' => false,
                'message' => $this->message,
                'errors' => $this->errors
            ], $this->status)
            ->setEncodingOptions(JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    private function getModelName(string $exceptionMsg): string
    {
        preg_match('~\[(.*?)\]~', $exceptionMsg, $output);
        $modelNamespace = $output[1];
        $namespaceSegments = explode('\\', $modelNamespace);
        $modelName = end($namespaceSegments);

        return lcfirst($modelName);
    }
}
