<?php

namespace App\Livewire\Backend;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Services\AdminService;
use App\Services\ProductService;
use App\Models\TikTokVideo;
use App\Models\ApplicationSetting;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public $stats = [];

    public function mount(AdminService $adminService)
    {
        // Get counts for dashboard
        $this->stats = [
            'total_users' => $adminService->getDataCount(),
            'active_users' => $adminService->getActiveData()->count(),
            'inactive_users' => $adminService->getInactiveData()->count(),
        ];

    }


    public function render()
    {
        return view('livewire.backend.dashboard');
    }
}