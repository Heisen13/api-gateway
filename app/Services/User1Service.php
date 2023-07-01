<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class User1Service{
use ConsumesExternalService;

public $baseUri;
public $secret;

public function __construct()
    {
    $this->baseUri = config('services.users1.base_uri');
    $this->secret = config('services.users2.secret');
    }

    public function create($data)
    {
        return $this->performRequest('POST', '/register', $data);
    }

    public function login($data)
    {
        return $this->performRequest('POST', '/login', $data);
    }

}