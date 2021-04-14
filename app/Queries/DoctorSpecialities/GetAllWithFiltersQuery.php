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

    private function filterByDoctor() {
        if ($this->request->filled('doctor_id')) {
            $this->query = $this->query->where('doctor_speciality.doctor_id', $this->request->doctor_id);
        }
    }

    private function joinSpecialities() {
        $this->query = $this->query->join('specialities', 'specialities.id', '=', 'speciality_id');
    }

    private function filterBySpeciality() {
        if ($this->request->filled('speciality_id')) {
            $this->query = $this->query->where('speciality_id', $this->request->speciality_id);
        }
    }

    private function orderBySpecialityName() {
        $this->query = $this->query->orderBy('name');
    }

    public function call() {
        $this->filterByDoctor();
        $this->joinSpecialities();
        $this->filterBySpeciality();
        // $this->orderBySpecialityName();

        return $this->query;
    }
}