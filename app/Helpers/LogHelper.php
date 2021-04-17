<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Log;
use App\Enums\ActionType;

class LogHelper {
    public static function log($action, $description, $record = null, $original_record = '') { 
        $request = request();
        $user = Auth::user();

        $log = new Log;
        $log->user_id = $user->id;
        $log->action = $action;
        $log->url = $request->path();
        $log->params = json_encode($request->all());
        $log->user_agent = $request->userAgent();
        $log->ip_address = $request->ip();
        $log->description = $description;

        if ($record) {
            $log->details = json_encode([json_encode($record), $original_record]);
            $log->record_type = get_class($record);
            $log->record_id = $record->id;
        }
    
        $log->save();
    }  

    public static function getStatusesForSelect() {
        $statuses = ActionType::asSelectArray();
    
        $callback = function($element) {
          $key = strtolower($element);
          return trans("models/log.status.{$key}");
        };
    
        return array_map($callback, $statuses);
      }
}