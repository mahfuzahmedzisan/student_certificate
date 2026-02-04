<?php

namespace App\Livewire\Backend\Student;

use App\Enums\StudentStatus;
use App\Livewire\Forms\StudentForm;
use App\Models\Student;
use App\Services\StudentService;
use App\Traits\Livewire\WithNotification;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads, WithNotification;

    public StudentForm $form;
    public Student $model;
    public $existingFile;

    protected StudentService $service;

    public function boot(StudentService $service)
    {
        $this->service = $service;
    }

    public function mount(Student $model): void
    {
        $this->model = $model;
        $this->form->setData($model);
        $this->existingFile = $model->avatar;
    }

    public function render()
    {
        return view('livewire.backend.student.edit', [
            'statuses' => StudentStatus::options(),
        ]);
    }

    public function save()
    {
        $validated = $this->form->validate();
        try {
            $validated['updated_by'] = admin()->id;
            $this->model = $this->service->updateData($this->model->id, $validated);

            $this->success('Data updated successfully');
            return $this->redirect(route('student.index'), navigate: true);
        } catch (\Throwable $e) {
            Log::error('Failed to update Student', [
                'student_id' => $this->model->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            $this->error('Failed to update Student.');
        }
    }

    public function resetForm(): void
    {
        $this->form->reset();
        $this->form->setData($this->model);
    }
}
