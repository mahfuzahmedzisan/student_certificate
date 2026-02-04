<?php

namespace App\Livewire\Frontend;

use App\Models\Student;
use App\Services\CertificateService;
use App\Services\StudentService;
use App\Traits\Livewire\WithNotification;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Home extends Component
{
    use WithNotification;
    
    protected StudentService $service;
    protected CertificateService $certificateService;

    public string $searchPassportId = '';
    public ?Student $foundStudent = null;
    public bool $showResult = false;
    public bool $notFound = false;
    public ?string $certificatePreview = null; // Base64 encoded PDF for preview

    protected $rules = [
        'searchPassportId' => 'required|exists:students,passport_id',
    ];

    protected $messages = [
        'searchPassportId.required' => '⚠️ Please enter your passport ID number',
        'searchPassportId.min' => '⚠️ Passport ID must be at least 5 characters',
        'searchPassportId.max' => '⚠️ Passport ID must not exceed 50 characters',
        'searchPassportId.regex' => '⚠️ Passport ID can only contain letters and numbers',
    ];

    public function boot(StudentService $service, CertificateService $certificateService)
    {
        $this->service = $service;
        $this->certificateService = $certificateService;
    }

    public function searchCertificate()
    {
        // Reset previous state
        $this->reset(['foundStudent', 'showResult', 'notFound', 'certificatePreview']);

        // Validate input
        $this->validate();

        // Sanitize input
        $sanitizedPassportId = strtoupper(trim($this->searchPassportId));

        try {
            // Search for student in database
            $this->foundStudent = Student::where('passport_id', $sanitizedPassportId)
                ->whereNull('deleted_at')
                ->first();

            if (!$this->foundStudent) {
                $this->notFound = true;
                $this->error('No certificate found with passport ID: ' . $sanitizedPassportId . '. Please verify your passport ID and try again.');
                return;
            }

            // If student is active, generate certificate preview
            if ($this->foundStudent->status->value === 'active') {
                try {
                    $pdfContent = $this->certificateService->downloadCertificate($this->foundStudent);
                    $this->certificatePreview = base64_encode($pdfContent);
                } catch (\Exception $e) {
                    Log::error('Certificate preview generation failed', [
                        'student_id' => $this->foundStudent->id,
                        'error' => $e->getMessage()
                    ]);
                    $this->warning('Certificate preview unavailable, but you can still download it.');
                }
            }

            $this->showResult = true;

            // Scroll to result
            $this->dispatch('scroll-to-result');

        } catch (\Exception $e) {
            $this->error('An error occurred while searching. Please try again later.');
            Log::error('Certificate search error: ' . $e->getMessage());
        }
    }

    public function resetSearch()
    {
        $this->reset(['searchPassportId', 'foundStudent', 'showResult', 'notFound', 'certificatePreview']);
        $this->resetValidation();
        
        // Scroll to top
        $this->dispatch('scroll-to-top');
    }

    public function updatedSearchPassportId($value)
    {
        // Auto-format: uppercase and remove special characters
        $this->searchPassportId = strtoupper(preg_replace('/[^A-Z0-9]/', '', $value));
        $this->resetValidation('searchPassportId');
    }

    public function downloadCertificate()
    {
        if (!$this->foundStudent || $this->foundStudent->status->value !== 'active') {
            $this->error('Certificate is not available for download yet.');
            return;
        }

        try {
            $pdfContent = $this->certificateService->downloadCertificate($this->foundStudent);
            $fileName = 'certificate-' . $this->foundStudent->name . '-' . $this->foundStudent->passport_id . '.pdf';

            // Dispatch download event to JavaScript
            $this->dispatch('download-certificate', [
                'pdfContent' => base64_encode($pdfContent),
                'fileName' => $fileName
            ]);

            $this->success('Certificate download started successfully!');
            
            Log::info('Certificate downloaded', [
                'student_id' => $this->foundStudent->id,
                'student_name' => $this->foundStudent->name,
                'passport_id' => $this->foundStudent->passport_id,
            ]);

        } catch (\Exception $e) {
            Log::error('Certificate download failed', [
                'student_id' => $this->foundStudent->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            $this->error('Failed to download certificate. Please try again or contact support.');
        }
    }

    public function render()
    {
        return view('livewire.frontend.home');
    }
}