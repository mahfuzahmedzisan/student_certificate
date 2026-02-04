<?php

namespace App\Actions\Student;


use App\Models\Student;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use App\Repositories\Contracts\StudentRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UpdateAction
{
    public function __construct(public StudentRepositoryInterface $interface) {}
    public function execute(int $id, array $data): Student
    {
        $newSingleImagePath = null;
        $uploadedPaths = [];

        try {
            // Start the database transaction
            return DB::transaction(function () use ($id, $data, &$newSingleImagePath ) {
                $admin = $this->interface->find($id);
                
                if (!$admin) {
                    Log::error('Student not found', ['student_id' => $id]);
                    throw new \Exception('Data not found');
                }
                $oldData = $admin->getAttributes();
                $newData = $data;
                // --- 1. Single Image Handling ---
                $oldImagePath = Arr::get($oldData, 'image');
                $uploadedImage = Arr::get($data, 'image');
                if ($uploadedImage instanceof UploadedFile) {
                    // Delete old file permanently (File deletion is non-reversible)
                    if ($oldImagePath && Storage::disk('public')->exists($oldImagePath)) {
                        Storage::disk('public')->delete($oldImagePath);
                    }
                    // Store the new file and track path for rollback
                    $prefix = uniqid('IMX') . '-' . time() . '-' . uniqid();
                    $fileName = $prefix . '-' . $uploadedImage->getClientOriginalName();

                    $newSingleImagePath = Storage::disk('public')->putFileAs('admins', $uploadedImage, $fileName);
                    $newData['image'] = $newSingleImagePath;
                } elseif (Arr::get($data, 'remove_file')) {
                    if ($oldImagePath && Storage::disk('public')->exists($oldImagePath)) {
                        Storage::disk('public')->delete($oldImagePath);
                    }
                    $newData['image'] = null;
                }
                // Cleanup temporary/file object keys
                if (!$newData['remove_file'] && !$newSingleImagePath) {
                    $newData['image'] = $oldImagePath ?? null;
                }
                unset($newData['remove_file']);



           
                // --- 4. Update Admin ---
                Log::info('Data sent to repository', ['data' => $newData]);
                $updated = $this->interface->update($id, $newData);

                if (!$updated) {
                    throw new \Exception('Failed to update Data');
                }

                // Refresh model and dispatch event
                $admin = $admin->fresh();
                $newAttributes = $admin->getAttributes();
                $changes = [];

                foreach ($newAttributes as $key => $value) {
                    if (in_array($key, ['created_at', 'updated_at', 'id'])) continue;
                    $oldValue = Arr::get($oldData, $key);
                    if ($oldValue !== $value) {
                        $changes[$key] = ['old' => $oldValue, 'new' => $value];
                    }
                }
                return $admin;
            });
        } catch (\Exception $e) {
            // --- FILE ROLLBACK MECHANISM: Delete files uploaded in this transaction ---

            // 1. Rollback single image file
            if ($newSingleImagePath && Storage::disk('public')->exists($newSingleImagePath)) {
                Storage::disk('public')->delete($newSingleImagePath);
                Log::warning('File Rollback: Deleted single new image file.', ['path' => $newSingleImagePath]);
            }

            // 2. Rollback multiple image files
            if (!empty($uploadedPaths)) {
                foreach ($uploadedPaths as $path) {
                    if (Storage::disk('public')->exists($path)) {
                        Storage::disk('public')->delete($path);
                    }
                }
                Log::warning('File Rollback: Deleted ' . count($uploadedPaths) . ' new multiple image files.');
            }

            // Re-throw the exception to communicate failure
            throw $e;
        }
    }
}
