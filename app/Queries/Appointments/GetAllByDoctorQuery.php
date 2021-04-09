<?php

namespace App\Queries\Appointments;

use Illuminate\Http\Request;
use App\Appointment;
use App\Speciality;
use App\User;
use App\Doctor;
use App\DoctorSpeciality;
use App\Enums\AppointmentStatus;

class GetAllByDoctorQuery {
    private Request $request;
    private User $user;
    private $query;
    private $hideAvailable;

    public function __construct(Request $request, User $user, $hideAvailable = false) {
        $this->request = $request;
        $this->user = $user;
        $this->query = Appointment::query();
        $this->hideAvailable = $hideAvailable;
    }

    private function isSpecialityFilled() {
        return $this->request->filled('speciality_id');
    }

    private function joinDoctorSpecialities() {
        $this->query = $this->query->leftJoin('doctor_speciality as doctor_speciality', 'doctor_speciality.id', '=', 'doctor_speciality_id')
                         ->select('appointments.*');
    }

    private function filterAllExceptGivenStatus() {
        if ($this->hideAvailable) {
            $this->query = $this->query->where('status', '!=', 0);
        }
    }

    private function filterAllByDoctor() {
        $this->query = $this->query->where('doctor_speciality.doctor_id', DoctorSpeciality::all()->where('doctor_id', $this->user->userable_id)->first()->doctor_id);
    }

    private function filterBySpeciality() {
        if ($this->request->filled('speciality_id')) {
            $this->query = $this->query->where('doctor_speciality.speciality_id', $this->request->speciality_id);
        }
    }

    private function filterByDate() {
        if ($this->request->filled('begin_date')) {
            $this->query = $this->query->whereBetween('begin_date', ["{$this->request->begin_date} 00:00:00", "{$this->request->begin_date} 23:59:59"]);
        }
    }

    private function filterByStatus() {
        if ($this->request->filled('status')) {
          $this->query = $this->query->where('status', $this->request->status);
        }
    }

    private function filterByPatient() {
        if ($this->request->filled('user_id')) {
          $this->query = $this->query->where('user_id', $this->request->user_id);
        }   
    }

    private function orderByDate() {
        $this->query = $this->query->orderBy('begin_date', 'ASC');
    }

    public function call() {
        $this->joinDoctorSpecialities();
        $this->filterAllByDoctor();
        $this->filterAllExceptGivenStatus();
        $this->filterBySpeciality();
        $this->filterByDate();
        $this->filterByStatus();
        $this->filterByPatient();
        $this->orderByDate();

        return $this->query;
    }
}