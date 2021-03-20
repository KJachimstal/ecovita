<?php

namespace App\Helpers;

use App\Enums\AppointmentStatus;

class AppointmentHelper {
  public static function getStatusesForSelect() {
    $statuses = AppointmentStatus::asSelectArray();

    $callback = function($element) {
      $key = strtolower($element);
      return trans("models/appointment.status.{$key}");
    };

    return array_map($callback, $statuses);
  }
}