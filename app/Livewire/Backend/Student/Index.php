<?php

namespace App\Livewire\Backend\Student;

use App\Enums\StudentStatus;
use App\Services\CertificateService;
use App\Services\StudentService;
use App\Traits\Livewire\WithDataTable;
use App\Traits\Livewire\WithNotification;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Index extends Component
{
    use WithDataTable, WithNotification;

    public $statusFilter = '';
    public $showDeleteModal = false;
    public $deleteDataId = null;
    public $bulkAction = '';
    public $showBulkActionModal = false;

    protected $listeners = ['studentCreated' => '$refresh', 'studentUpdated' => '$refresh'];

    protected StudentService $service;
    protected CertificateService $certificateService;

    public function boot(StudentService $service, CertificateService $certificateService): void
    {
        $this->service = $service;
        $this->certificateService = $certificateService;
    }

    public function render()
    {
        $datas = $this->service->getPaginatedData(
            perPage: $this->perPage,
            filters: $this->getFilters()
        );

        $datas->load('creater_admin');

        $columns = [
            [
                'key' => 'image',
                'label' => 'Image',
                'format' => function ($data) {
                    return $data->image
                        ? '<img src="' . $data->image_url . '" alt="' . $data->name . '" class="w-10 h-10 rounded-full object-cover shadow-sm">'
                        : '<div class="w-10 h-10 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-600 dark:text-gray-300 font-semibold">' . strtoupper(substr($data->name, 0, 2)) . '</div>';
                }
            ],
            [
                'key' => 'name',
                'label' => 'Name',
                'sortable' => true
            ],
            [
                'key' => 'phone',
                'label' => 'Phone',
                'sortable' => true
            ],
            [
                'key' => 'passport_id',
                'label' => 'Passport',
                'sortable' => true
            ],
            [
                'key' => 'reference_by',
                'label' => 'Reference By',
                'sortable' => true
            ],
            [
                'key' => 'status',
                'label' => 'Status',
                'sortable' => true,
                'format' => function ($data) {
                    return '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium badge badge-soft ' . $data->status->color() . '">' .
                        $data->status->label() .
                        '</span>';
                }
            ],
            [
                'key' => 'created_at',
                'label' => 'Created',
                'sortable' => true,
                'format' => function ($data) {
                    return $data->created_at_formatted;
                }
            ],
            [
                'key' => 'created_by',
                'label' => 'Created By',
                'format' => function ($data) {
                    return optional($data->creater_admin)->name
                        ? '<span class="text-sm font-medium text-gray-900 dark:text-gray-100">' . e($data->creater_admin->name) . '</span>'
                        : '<span class="text-sm text-gray-500 dark:text-gray-400 italic">System</span>';
                },
                'sortable' => true,
            ],
        ];

        $actions = [
            [
                'key' => 'id',
                'label' => 'View',
                'route' => 'student.view',
                'encrypt' => true
            ],
            [
                'key' => 'id',
                'label' => 'Edit',
                'route' => 'student.edit',
                'encrypt' => true
            ],
            [
                'key' => 'id',
                'label' => 'Download Certificate',
                'method' => "downloadCertificate",
                'encrypt' => true
            ],
            [
                'key' => 'id',
                'label' => 'Update Status',
                'method' => 'statusUpdate',
                'encrypt' => true
            ],
            [
                'key' => 'id',
                'label' => 'Delete',
                'method' => 'confirmDelete',
                'encrypt' => true
            ],
        ];

        $bulkActions = [
            ['value' => 'delete', 'label' => 'Delete'],
            ['value' => 'activate', 'label' => 'Activate'],
            ['value' => 'inactive', 'label' => 'Inactive'],
        ];

        return view('livewire.backend.student.index', [
            'datas' => $datas,
            'statuses' => StudentStatus::options(),
            'columns' => $columns,
            'actions' => $actions,
            'bulkActions' => $bulkActions,
        ]);
    }

    public function downloadCertificate($encryptedId)
    {
        $studentId = decrypt($encryptedId);
        $student = $this->service->findData($studentId);
        if (!$student) {
            return $this->error('Student not found');
        }

        $pdfContent = $this->certificateService->downloadCertificate($student);
        $fileName = 'certificate-' . $student->name . '.pdf';

        $this->dispatch('download-pdf', base64_encode($pdfContent), $fileName);
    }

    public function confirmDelete($encryptedId): void
    {
        $this->deleteDataId = decrypt($encryptedId);
        $this->showDeleteModal = true;
    }
    public function statusUpdate($encryptedId): void
    {

        try {
            $studentId = decrypt($encryptedId);

            $data = $this->service->findData($studentId);
            $status = $data->status == StudentStatus::ACTIVE ? StudentStatus::INACTIVE : StudentStatus::ACTIVE;

            $data->update(['status' => $status]);


            $this->success('Data status updated successfully');
        } catch (\Throwable $e) {
            Log::error('Failed to delete Student', [
                'student_id' => $studentId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            $this->error('Failed to delete Admin.');
        }
    }

    public function delete(): void
    {
        try {
            if (!$this->deleteDataId) {
                return;
            }

            if ($this->deleteDataId == admin()->id) {
                $this->error('You cannot delete your own account');
                return;
            }

            $this->service->deleteData($this->deleteDataId);

            $this->showDeleteModal = false;
            $this->deleteDataId = null;

            $this->success('Data deleted successfully');
        } catch (\Throwable $e) {
            Log::error('Failed to delete Student', [
                'student_id' => $this->deleteDataId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            $this->error('Failed to delete Admin.');
        }
    }

    public function resetFilters(): void
    {
        $this->reset(['search', 'statusFilter', 'perPage', 'sortField', 'sortDirection', 'selectedIds', 'selectAll', 'bulkAction']);
        $this->resetPage();
    }

    public function confirmBulkAction(): void
    {
        if (empty($this->selectedIds) || empty($this->bulkAction)) {
            $this->warning('Please select Datas and an action');
            Log::info('No datas selected or no bulk action selected');
            return;
        }

        $this->showBulkActionModal = true;
    }

    public function executeBulkAction(): void
    {
        $this->showBulkActionModal = false;

        try {
            match ($this->bulkAction) {
                'delete' => $this->bulkDelete(),
                'activate' => $this->bulkUpdateStatus(StudentStatus::ACTIVE),
                'inactive' => $this->bulkUpdateStatus(StudentStatus::INACTIVE),
                default => null,
            };

            $this->selectedIds = [];
            $this->selectAll = false;
            $this->bulkAction = '';
        } catch (\Exception $e) {
            $this->error('Bulk action failed: ' . $e->getMessage());
        }
    }

    protected function bulkDelete(): void
    {
        $count = $this->service->bulkDeleteData($this->selectedIds, admin()->id);

        $this->success("{$count} Datas deleted successfully");
    }

    protected function bulkUpdateStatus(StudentStatus $status): void
    {
        $count = $this->service->bulkUpdateStatus($this->selectedIds, $status);
        $this->success("{$count} Datas updated successfully");
    }

    protected function getFilters(): array
    {
        return [
            'search' => $this->search,
            'status' => $this->statusFilter,
            'sort_field' => $this->sortField,
            'sort_direction' => $this->sortDirection,
        ];
    }

    protected function getSelectableIds(): array
    {
        $ids =  $this->service->getPaginatedData(
            perPage: $this->perPage,
            filters: $this->getFilters()
        )->pluck('id')->toArray();
        return $ids;
    }

    public function updatedStatusFilter(): void
    {
        $this->resetPage();
    }
}
