<?php

namespace App\Livewire\Forms;

use App\Enums\StudentStatus;
use Illuminate\Http\UploadedFile;
use Livewire\Attributes\Locked;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\Form;

class StudentForm extends Form
{
    use WithFileUploads;

    #[Locked]
    public ?int $id = null;

    public string $name = '';
    public string $phone = '';
    public string $status = StudentStatus::ACTIVE->value;
    public ?UploadedFile $image = null;
    public bool $remove_file = false;

    public ?string $address = '';
    public ?string $passport_id = '';
    public ?string $reference_by = '';
    public ?string $reference_contact = '';
    public $payment = 0;

    public function rules(): array
    {

        $phone = $this->isUpdating() ? 'required|string|max:255|unique:students,phone,' . $this->id : 'required|string|max:255|unique:students,phone';
        return [
            'name' => 'required|string|max:50',
            'phone' => $phone,
            'remove_file'      => 'boolean',
            'address' => 'required|string',
            'passport_id' => 'required|string',
            'reference_by' => 'nullable|string',
            'reference_contact' => 'nullable|string',
            'payment' => 'required|min:0',
            'status' => 'required|string|in:' . implode(',', array_column(StudentStatus::cases(), 'value')),
            'image' => 'nullable|image',
        ];
    }

    public function setData($student): void
    {
        $this->id = $student->id;
        $this->name = $student->name;
        $this->phone = $student->phone;
        $this->address = $student->address;
        $this->passport_id = $student->passport_id;
        $this->reference_by = $student->reference_by;
        $this->reference_contact = $student->reference_contact;
        $this->payment = $student->payment;
        $this->status = $student->status->value;
    }

    public function reset(...$properties): void
    {
        $this->id = null;
        $this->name = '';
        $this->phone = '';
        $this->status = StudentStatus::ACTIVE->value;
        $this->image = null;
        $this->address = '';
        $this->passport_id = '';
        $this->reference_by = '';
        $this->reference_contact = '';
        $this->payment = 0;
        $this->resetValidation();
    }

    protected function isUpdating(): bool
    {
        return !empty($this->id);
    }
}
