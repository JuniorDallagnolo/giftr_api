<?php

class Response
{
    public $code;
    public $data;
    public $message;

    public function __construct($HTTPStatusCode, $payload, $message)
    {
        $this->code = $HTTPStatusCode;
        $this->data = $payload;
        $this->message = $message;
    }

    public function send()
    {
        $this->setHeaders();
        echo json_encode($this);
    }

    private function setHeaders()
    {
        header('Content-type: application/json');
        switch ($this->code) {
            case 200:
                header('HTTP/1.1 200 OK');
                break;
            case 201:
                header('HTTP/1.1 201 Created');
                break;
            case 202:
                header('HTTP/1.1 202 Accepted');
                break;
            case 400:
                header('HTTP/1.1 400 Bad Request');
                break;
            case 401:
                header('HTTP/1.1 401 Unauthorized');
                break;
            case 403:
                header('HTTP/1.1 403 Forbidden');
                break;
            case 404:
                header('HTTP/1.1 404 Not Found');
                break;
            case 405:
                header('HTTP/1.1 405 Method Not Allowed');
                break;
            case 500:
                header('HTTP/1.1 500 Internal Server Error');
                break;
        }
    }
}
    