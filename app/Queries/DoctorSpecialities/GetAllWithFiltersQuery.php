<?php

namespace App\Queries\DoctorSpecialities;
use Illuminate\Http\Request;
use App\DoctorSpeciality;

class GetAllWithFiltersQuery {
    
    private Request $request;
    private $query;

    public function __construct(Request $request = null, Bolean $allDoctors = null) {
        $this->request = $request;
        $this->query = DoctorSpeciality::query();

        if ($allDoctors) {
            $this->query = $this->query->all();
        }
    }

    private function filterByDoctor() {
        if ($this->request->filled('doctor_id')) {
            $this->query = $this->query->where('doctor_speciality.doctor_id', $this->request->doctor_id);
        }
    }

    public function call() {
        $this->filterByDoctor();

        return $this->query;
    }
}