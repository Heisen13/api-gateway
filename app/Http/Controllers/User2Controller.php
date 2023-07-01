<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use DB;
use App\Services\User2Service;

Class User2Controller extends Controller {
use ApiResponser;   

public function checkIn(Request $request)
{
    $user = Auth::user();

    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }

    $attendance = Attendance::where('user_id', $user->id)
        ->whereNull('check_out_time')
        ->first();

    if ($attendance) {
        return response()->json(['message' => 'You have already checked in'], 400);
    }

    $attendance = new Attendance;
    $attendance->user_id = $user->id;
    $attendance->date = Carbon::now()->toDateString();
    $attendance->check_in_time = Carbon::now()->toTimeString();
    $attendance->save();

    return response()->json(['message' => 'Check-in successful']);
}

public function checkOut(Request $request)
{
    $user = Auth::user();

    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }

    $attendance = Attendance::where('user_id', $user->id)
        ->whereDate('date', Carbon::now()->toDateString())
        ->whereNotNull('check_in_time')
        ->whereNull('check_out_time')
        ->first();

    if (!$attendance) {
        return response()->json(['message' => 'You have not checked in'], 400);
    }

    $attendance->check_out_time = Carbon::now()->toTimeString();
    $attendance->save();

    return response()->json(['message' => 'Check-out successful']);
}

}