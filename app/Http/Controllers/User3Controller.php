<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use DB;
use App\Services\User3Service;

Class User3Controller extends Controller {
use ApiResponser;   

public $user3Service;

public function __construct(User3Service $user3Service){
    $this->user3Service = $user3Service;
}

public function reportAllAttendances()
{
    return $this->successResponse($this->user3Service->getreportAllAttendances());
}

public function reportAttendances($id)
{
    return $this->successResponse($this->user3Service->getAttendances($id));
}

public function reportUserAttendances($userId)
{
    return $this->successResponse($this->user3Service->getUserAttendances($userId));
}

}