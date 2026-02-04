<?php

namespace App\Livewire\Backend\Student;


use App\Enums\StudentStatus;
use App\Livewire\Forms\StudentForm;
use App\Services\StudentService;
use App\Traits\Livewire\WithNotification;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads, WithNotification;

    public StudentForm $form;

    protected StudentService $service;

    public function boot(StudentService $service)
    {
        $this->service = $service;
    }

    public function render()
    {
        return view('livewire.backend.student.create', [
            'statuses' => StudentStatus::options(),
        ]);
    }
    public function save()
    {
        $validated = $this->form->validate();
        try {
            $validated['created_by'] = admin()->id;
            $this->service->createData($validated);
            $this->success('Data created successfully');
            return $this->redirect(route('student.index'), navigate: true);
        } catch (\Exception $e) {
            Log::error('Failed to create user: ' . $e->getMessage());

            $this->error('Failed to create user.');
        }
    }

    public function resetForm(): void
    {
        $this->form->reset();
    }
}
