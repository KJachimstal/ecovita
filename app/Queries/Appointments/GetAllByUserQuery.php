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

    public function __construct(User $user) {
        $this->user = $user;
        $this->query = Appointment::query();
    }

    private function joinDetails() {
        $this->query = $this->query->join('details', 'details.appointment_id', '=', 'id')
                        ->select('details.*');
    }

    private function filterByUser() {
        $this->query = $this->query->where('user_id', $this->user->id);
    }

    public function call() {
        $this->filterByUser();
        $this->joinDetails();

        return $this->query;
    }
}