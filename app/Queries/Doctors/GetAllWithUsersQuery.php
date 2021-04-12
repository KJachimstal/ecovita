<?php

namespace App\Queries\Doctors;

use App\Doctor;
use DB;

class GetAllWithUsersQuery {

    private $query;
    private $speciality_id;

    public function __construct($speciality_id = null) {
        $this->query = Doctor::query();
        $this->speciality_id = $speciality_id;
    }

    private function joinUsers() {
        $this->query = $this->query->leftJoin('users', function($join) {
          $join->on('users.userable_id', '=', 'doctors.id');
          $join->where('users.userable_type', '=', 'App\Doctor');
        });
    }

    private function joinDoctorSpecialities() {
        $this->query = $this->query->leftJoin('doctor_speciality', function($join) {
          $join->on('doctor_speciality.doctor_id', '=', 'doctors.id');
        });
    }

    private function selectFields() {
        $this->query = $this->query->select(
          DB::raw('CONCAT(users.first_name, " ", users.last_name) AS full_name'), 'doctors.id'
        );
    }

    private function filterBySpeciality() {
        if ($this->speciality_id) {
            $this->joinDoctorSpecialities();
            $this->query = $this->query->where('doctor_speciality.speciality_id', $this->speciality_id);
        }
    }

    private function orderByName() {
        $this->query = $this->query->orderBy('users.first_name', 'ASC');
    }

    public function call() {
        $this->joinUsers();
        $this->filterBySpeciality();
        $this->selectFields();
        $this->orderByName();
        
        return $this->query;
    }
}