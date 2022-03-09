<?php


namespace App\Source\Resources;

trait BaseResource
{
    public bool $status = true;
    public string $message = '';
    public ?array $errors = null;

    public function with($request)
    {
        return [
            'status' => $this->status,
            'message' => $this->message,
            'errors' => $this->errors ?? json_decode('{}'),
        ];
    }

    public function withResponse($request, $response)
    {
        $response->setEncodingOptions(JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }
}
