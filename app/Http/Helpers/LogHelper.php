<?php

namespace App\Http\Helpers;

use App\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LogHelper {
  public static function log(string $description) {
    $user = Auth::user();

    $log = new Log;
    $log->user_id = $user->id;
    $log->full_name = $user->fullName;
    $log->ip_address = request()->ip();
    $log->description = $description;
    $log->save();
  }
}