<?php

namespace App\Queries\Doctors;

use App\Doctor;
use DB;

class GetAllWithUsersQuery {

    private $query;

    public function __construct() {
        $this->query = Doctor::query();
    }

    private function joinUsers() {
      return $this->query->leftJoin('users', function($join) {
        $join->on('users.userable_id', '=', 'doctors.id');
        $join->where('users.userable_type', '=', 'App\Doctor');
      });
    }

    private function selectFields() {
        return $this->query->select(
          DB::raw('CONCAT(users.first_name, " ", users.last_name) AS full_name'), 'doctors.id'
        );
    }

    public function call() {
        $this->query = $this->joinUsers();
        $this->query = $this->selectFields();
        
        return $this->query;
    }
}