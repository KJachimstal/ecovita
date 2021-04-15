<?php 

namespace App\Queries\Appointments;

use Illuminate\Http\Request;
use App\Appointment;
use App\DoctorSpeciality;
use App\User;
use App\Enums\AppointmentStatus;
use App\Detail;

class GetAllByUserQuery {
    private $query;
    private $user;
    private $speciality_id;

    public function __construct(User $user, $speciality_id) {
        $this->user = $user;
        $this->speciality_id = $speciality_id;
        $this->query = Appointment::query();
    }

    private function joinDetails() {
        $this->query = $this->query->join('details', 'details.appointment_id', '=', 'appointments.id');
    }

    private function joinDoctorSpecialities() {
        $this->query = $this->query->join('doctor_speciality', 'doctor_speciality.id', '=', 'appointments.doctor_speciality_id');
    }

    private function filterByUser() {
        $this->query = $this->query->where('user_id', $this->user->id);
    }

    private function filterByFinishedStatus() {
        $this->query = $this->query->where('status', AppointmentStatus::Finished);
    }

    private function filterBySpeciality() {
        $this->query = $this->query->where('doctor_speciality.speciality_id', $this->speciality_id);
    }

    public function call() {
        $this->joinDetails();
        $this->joinDoctorSpecialities();
        $this->filterByUser();
        $this->filterBySpeciality();
        $this->filterByFinishedStatus();

        return $this->query;
    }
}

// >>> Appointment::query()->join('doctor_speciality', 'doctor_speciality.id', '=', 'doctor_speciality_id')->join('details', 'details.appointment_id', '=', 'appointments.id')->join('specialities', 'specialities.speciality_id', 'id')->get()->first()
// Illuminate\Database\QueryException with message 'SQLSTATE[42S22]: Column not found: 1054 Unknown column 'specialities.speciality_id' in 'on clause' (SQL: select * from `appointments` inner join `doctor_speciality` on `doctor_speciality`.`id` = `doctor_speciality_id` inner join `details` on `details`.`appointment_id` = `appointments`.`id` inner join `specialities` on `specialities`.`speciality_id` = `id`)'
// >>> Appointment::query()->join('doctor_speciality', 'doctor_speciality.id', '=', 'doctor_speciality_id')->join('details', 'details.appointment_id', '=', 'appointments.id')->join('specialities', 'specialities.id', 'id')->get()->first()
// Illuminate\Database\QueryException with message 'SQLSTATE[23000]: Integrity constraint violation: 1052 Column 'id' in on clause is ambiguous (SQL: select * from `appointments` inner join `doctor_speciality` on `doctor_speciality`.`id` = `doctor_speciality_id` inner join `details` on `details`.`appointment_id` = `appointments`.`id` inner join `specialities` on `specialities`.`id` = `id`)'
// >>> Appointment::query()->join('doctor_speciality', 'doctor_speciality.id', '=', 'doctor_speciality_id')->join('specialities', 'specialities.id', 'id')->get()->first()
// Illuminate\Database\QueryException with message 'SQLSTATE[23000]: Integrity constraint violation: 1052 Column 'id' in on clause is ambiguous (SQL: select * from `appointments` inner join `doctor_speciality` on `doctor_speciality`.`id` = `doctor_speciality_id` inner join `specialities` on `specialities`.`id` = `id`)'
// >>> Appointment::query()->join('doctor_speciality', 'doctor_speciality.id', '=', 'doctor_speciality_id')->join('specialities', 'specialities.id', 'appointment.id')->get()->first()
// Illuminate\Database\QueryException with message 'SQLSTATE[42S22]: Column not found: 1054 Unknown column 'appointment.id' in 'on clause' (SQL: select * from `appointments` inner join `doctor_speciality` on `doctor_speciality`.`id` = `doctor_speciality_id` inner join `specialities` on `specialities`.`id` = `appointment`.`id`)'
// >>> Appointment::query()->join('doctor_speciality', 'doctor_speciality.id', '=', 'doctor_speciality_id')->join('details', 'details.appointment_id', '=', 'appointments.id')->join('specialities', 'specialities.id', 'id')->get()->first()