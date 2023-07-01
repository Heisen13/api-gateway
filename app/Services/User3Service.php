<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class User3Service{
use ConsumesExternalService;

public $baseUri;
public $secret;

public function __construct()
    {
    $this->baseUri = config('services.users3.base_uri');
    $this->secret = config('services.users3.secret');
    }

public function getreportAllAttendances()
    {
    return $this->performRequest('GET','/reports');
    }
    
public function getAttendances($id)
    {
    return $this->performRequest('GET',"/reports/{$id}");
    }

public function getUserAttendances($userId)
    {
    return $this->performRequest('GET',"/reports/user/{$userId}");
    }

}