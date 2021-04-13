<?php 

namespace App\Queries\Appointments;

use Illuminate\Http\Request;
use App\Appointment;
use App\User;
use App\Enums\AppointmentStatus;
use App\Detail;

class GetAllByUserQuery {
    private $query;
    private $user;
    private $doctor_speciality_id;

    public function __construct(User $user, $doctor_speciality_id) {
        $this->user = $user;
        $this->doctor_speciality_id = $doctor_speciality_id;
        $this->query = Appointment::query();
    }

    private function joinDetails() {
        $this->query = $this->query->join('details', 'details.appointment_id', '=', 'appointments.id')
                        ->get();
    }

    private function filterByUser() {
        $this->query = $this->query->where('user_id', $this->user->id);
    }

    private function filterByFinishedStatus() {
        $this->query = $this->query->where('status', AppointmentStatus::Finished);
    }

    private function filterByDoctorSpeciality() {
        $this->query = $this->query->where('doctor_speciality_id', $this->doctor_speciality_id);
    }

    public function call() {
        $this->filterByUser();
        $this->joinDetails();
        $this->filterByDoctorSpeciality();
        $this->filterByFinishedStatus();

        return $this->query;
    }
}