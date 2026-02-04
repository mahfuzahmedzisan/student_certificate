<?php

namespace App\Livewire\Backend\Student;


use App\Models\Student;
use Livewire\Component;

class View extends Component
{
    public Student $model;
    public function mount(Student $model): void
    {
        $this->model = $model;
    }
    public function render()
    {
        return view('livewire.backend.student.view');
    }
}
