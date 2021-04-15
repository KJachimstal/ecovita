<?php

namespace App\Queries\DoctorSpecialities;
use Illuminate\Http\Request;
use App\DoctorSpeciality;

class GetAllWithFiltersQuery {
    
    private Request $request;
    private $query;

    public function __construct(Request $request = null) {
        $this->request = $request;
        $this->query = DoctorSpeciality::query();
    }

    private function joinUsers() {
        $this->query = $this->query->leftJoin('users', function($join) {
            $join->on('users.userable_id', '=', 'doctor_speciality.doctor_id');
            $join->where('users.userable_type', '=', 'App\Doctor');
        });
    }

    private function filterByDoctor() {
        if ($this->request->filled('doctor_id')) {
            $this->query = $this->query->where('doctor_speciality.doctor_id', $this->request->doctor_id);
        }
    }

    private function filterBySpeciality() {
        if ($this->request->filled('speciality_id')) {
            $this->query = $this->query->where('speciality_id', $this->request->speciality_id);
        }
    }

    private function orderByDoctor() {
        $this->query = $this->query->orderBy('users.last_name');
    }

    public function call() {
        $this->joinUsers();
        $this->filterByDoctor();
        $this->filterBySpeciality();
        $this->orderByDoctor();
        $this->query = $this->query->select('doctor_speciality.id', 'doctor_speciality.speciality_id', 'doctor_speciality.doctor_id');

        return $this->query;
    }
}