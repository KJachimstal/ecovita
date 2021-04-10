<?php

namespace App\Helpers;

use App\Enums\AppointmentStatus;
use Carbon\Carbon;

class AppointmentHelper {
  public static function getStatusesForSelect() {
    $statuses = AppointmentStatus::asSelectArray();

    $callback = function($element) {
      $key = strtolower($element);
      return trans("models/appointment.status.{$key}");
    };

    return array_map($callback, $statuses);
  }

  public static function getAppointmentsByDays($appointments) {
    $today = Carbon::today();
    $dailyAppointments = [];

    for ($i = 0; $i < 30; $i++) {
        $thisDay = $today->copy()->add('day', $i);

        $dayAppointments = [];
        foreach ($appointments as $appointment) {
            $date = Carbon::parse($appointment->begin_date)->startOfDay();
            if ($date->equalTo($thisDay)) {
                $dayAppointments []= $appointment;
            }
        }

        $dailyAppointments[] = [
            'date' => $thisDay,
            'items' => $dayAppointments,
            'count' => count($dayAppointments)
        ];
    }

    return $dailyAppointments;
}
}