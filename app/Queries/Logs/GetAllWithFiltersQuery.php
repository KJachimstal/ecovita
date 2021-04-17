<?php

namespace App\Queries\Logs;
use Illuminate\Http\Request;
use App\Log;

class GetAllWithFiltersQuery {
    
    private Request $request;
    private $query;

    public function __construct(Request $request = null) {
        $this->request = $request;
        $this->query = Log::query();
    }

    private function filterByUser() {
        if ($this->request->filled('user_id')) {
            $this->query = $this->query->where('user_id', $this->request->user_id);
        }
    }

    private function filterByAction() {
        if ($this->request->filled('action')) {
            $this->query = $this->query->where('action', $this->request->action);
        }
    }

    private function filterByDate() {
        if ($this->request->filled('created_at')) {
            $this->query = $this->query->whereBetween('created_at', ["{$this->request->created_at} 00:00:00", "{$this->request->created_at} 23:59:59"]);
        }
    }

    private function orderByDate() {
        $this->query = $this->query->orderBy('created_at', 'DESC');
    }

    public function call() {
        $this->filterByUser();
        $this->filterByAction();
        $this->filterByDate();
        $this->orderByDate();

        return $this->query;
    }
}