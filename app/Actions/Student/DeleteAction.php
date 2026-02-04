<?php

namespace App\Actions\Student;

use App\Models\Student;
use App\Repositories\Contracts\StudentRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DeleteAction
{
    public function __construct(public StudentRepositoryInterface $interface) {}

    public function execute(int $id, bool $forceDelete = false, $actionerId): bool
    {
        return DB::transaction(function () use ($id, $forceDelete, $actionerId) {
            $model = null;
            if ($forceDelete) {
                $model = $this->interface->findTrashed(column_value: $id);
            } else {
                $model = $this->interface->find(column_value: $id);
            }

            if (!$model) {
                throw new \Exception('Student not found');
            }

            if ($forceDelete) {
                // Delete avatar
                if ($model->avatar) {
                    Storage::disk('public')->delete($model->avatar);
                }

                return $this->interface->forceDelete($id);
            }

            return $this->interface->delete($id, $actionerId);
        });
    }
}
