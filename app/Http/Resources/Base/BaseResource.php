<?php


namespace App\Http\Resources\Base;

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
}
