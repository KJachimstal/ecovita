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
    private $onlyForUser;
    private $query;

    public function __construct(Request $request, User $user, $onlyForUser = false) {
        $this->request = $request;
        $this->user = $user;
        $this->onlyForUser = $onlyForUser;
        $this->query = $this->getQueryType();
    }

    private function getQueryType() {
        if ($this->onlyForUser) return Appointment::where('user_id', $this->user->id);
        if ($this->user->isActiveEmployee) return Appointment::query();
      
        return Appointment::where('status', AppointmentStatus::Available);
    }

    private function isSpecialityOrDoctorFilled() {
        return $this->request->filled('speciality_id') || $this->request->filled('doctor_id');
    }

    private function joinDoctorSpecialities() {
        $this->query = $this->query->leftJoin('doctor_speciality as doctor_speciality', 'doctor_speciality.id', '=', 'doctor_speciality_id')
                         ->select('appointments.*');
    }

    private function filterBySpeciality() {
        if ($this->request->filled('speciality_id'))
        $this->query = $this->query->where('doctor_speciality.speciality_id', $this->request->speciality_id);
    }

    private function filterByDoctor() {
        if ($this->request->filled('doctor_id'))
        $this->query = $this->query->where('doctor_speciality.doctor_id', $this->request->doctor_id);
    }

    private function filterByDate() {
        if ($this->request->filled('begin_date'))
        $this->query = $this->query->whereBetween('begin_date', ["{$this->request->begin_date} 00:00:00", "{$this->request->begin_date} 23:59:59"]);
    }

    private function filterByStatus() {
        if ($this->request->filled('status')) {
          $this->query = $this->query->where('status', $this->request->status);
        }   
    }

    public function call() {
      if ($this->isSpecialityOrDoctorFilled()) {
        $this->joinDoctorSpecialities();
        $this->filterBySpeciality();
        $this->filterByDoctor();
      }
      
      $this->filterByDate();
      $this->filterByStatus();

    //   Return query results
      return $this->query;
    }
}