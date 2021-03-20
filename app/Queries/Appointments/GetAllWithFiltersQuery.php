<?php

namespace App\Queries\Appointments;

use App\Appointment;
use App\Speciality;
use App\Doctor;
use App\User;
use App\Enums\AppointmentStatus;
use Illuminate\Http\Request;

class GetAllWithFiltersQuery {
    private Request $request;
    private User $user;
    private $query;

    public function __construct(Request $request, User $user) {
        $this->request = $request;
        $this->user = $user;
        $this->query = $user->isActiveEmployee ? Appointment::query() : Appointment::where('status', AppointmentStatus::Available);
    }

    private function isSpecialityOrDoctorFilled() {
      return $this->request->filled('speciality_id') || $this->request->filled('doctor_id');
    }

    private function joinDoctorSpecialities() {
      return $this->query->leftJoin('doctor_speciality as doctor_speciality', 'doctor_speciality.id', '=', 'doctor_speciality_id')
                         ->select('appointments.*');
    }

    private function filterBySpeciality() {
      if (!$this->request->filled('speciality_id')) return $this->query;

      return $this->query->where('doctor_speciality.speciality_id', $this->request->speciality_id);
    }

    private function filterByDoctor() {
      if (!$this->request->filled('doctor_id')) return $this->query;

      return $this->query->where('doctor_speciality.doctor_id', $this->request->doctor_id);
    }

    private function filterByDate() {
      if (!$this->request->filled('begin_date')) return $this->query;

      return $this->query->whereBetween('begin_date', ["{$this->request->begin_date} 00:00:00", "{$this->request->begin_date} 23:59:59"]);
    }

    public function call() {
      if ($this->isSpecialityOrDoctorFilled()) {
        $this->query = $this->joinDoctorSpecialities();
        $this->query = $this->filterBySpeciality();
        $this->query = $this->filterByDoctor();
      }

      $this->query = $this->filterByDate();

      // Return query results
      return $this->query;
    }
}