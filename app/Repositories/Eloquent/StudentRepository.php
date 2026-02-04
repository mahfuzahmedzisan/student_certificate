<?php

namespace App\Repositories\Eloquent;

use App\Models\Student;
use App\Repositories\Contracts\StudentRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;


class StudentRepository implements StudentRepositoryInterface
{
    public function __construct(protected Student $model) {}

    /* ================== ================== ==================
    *                      Find Methods 
    * ================== ================== ================== */

    public function all(string $sortField = 'created_at', $order = 'desc'): Collection
    {

        $query = $this->model->query();

        return $query->orderBy($sortField, $order)->get();
    }

    public function find($column_value, string $column_name = 'id', bool $trashed = false): ?Student
    {
        $model = $this->model;
        if ($trashed) {
            $model = $model->withTrashed();
        }
        return $model->where($column_name, $column_value)->first();
    }


    public function findTrashed($column_value, string $column_name = 'id'): ?Student
    {
        $model = $this->model->onlyTrashed();

        return $model->where($column_name, $column_value)->first();
    }

    public function paginate(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        $search = $filters['search'] ?? null;
        $sortField = $filters['sort_field'] ?? 'created_at';
        $sortDirection = $filters['sort_direction'] ?? 'desc';

        if ($search) {
            // Scout Search
            return Student::search($search)
                ->query(fn($query) => $query->filter($filters)->orderBy($sortField, $sortDirection))
                ->paginate($perPage);
        }

        // Normal Eloquent Query
        return $this->model->query()
            ->filter($filters)
            ->orderBy($sortField, $sortDirection)
            ->paginate($perPage);
    }


    public function trashPaginate(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        $search = $filters['search'] ?? null;
        $sortField = $filters['sort_field'] ?? 'deleted_at';
        $sortDirection = $filters['sort_direction'] ?? 'desc';

        if ($search) {
            // 👇 Manually filter trashed + search
            return Student::search($search)
                ->onlyTrashed()
                ->query(fn($query) => $query->filter($filters)->orderBy($sortField, $sortDirection))
                ->paginate($perPage);
        }

        return $this->model->onlyTrashed()
            ->filter($filters)
            ->orderBy($sortField, $sortDirection)
            ->paginate($perPage);
        return $query->paginate($perPage);
    }


    public function exists(int $id): bool
    {
        return $this->model->where('id', $id)->exists();
    }

    public function count(array $filters = []): int
    {
        $query = $this->model->query();

        if (!empty($filters)) {
            $query->filter($filters);
        }

        return $query->count();
    }

    public function search(string $query, string $sortField = 'created_at', $order = 'desc'): Collection
    {
        return $this->model->search($query)->orderBy($sortField, $order)->get();
    }


    /* ================== ================== ==================
    *                    Data Modification Methods 
    * ================== ================== ================== */

    public function create(array $data): Student
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): bool
    {

        $findData = $this->find($id);

        if (!$findData) {
            return false;
        }
        
        return $findData->update($data);
    }

    public function delete(int $id, $actionerId): bool
    {
        $findData = $this->find($id);

        if (!$findData) {
            return false;
        }

        $findData->update(['deleted_by' => $actionerId]);

        return $findData->delete();
    }

    public function forceDelete(int $id): bool
    {
        $findData = $this->findTrashed($id);

        if (!$findData) {
            return false;
        }

        return $findData->forceDelete();
    }

    public function restore(int $id, int $actionerId): bool
    {
        $findData = $this->findTrashed($id);

        if (!$findData) {
            return false;
        }
        $findData->update(['restored_by' => $actionerId, 'restored_at' => now(), 'deleted_by' => null]);

        return $findData->restore();
    }


    public function bulkUpdateStatus(array $ids, string $status, $actionerId): int
    {

        return $this->model->withTrashed()->whereIn('id', $ids)->update(['status' => $status, 'updated_by' => $actionerId]);
    }

    public function bulkRestore(array $ids, int $actionerId): int
    {

        $this->model->onlyTrashed()->whereIn('id', $ids)->update(['restored_by' => $actionerId, 'restored_at' => now(), 'deleted_by' => null]);

        return $this->model->onlyTrashed()->whereIn('id', $ids)->restore();
    }

    public function bulkDelete(array $ids, int $actionerId): int
    {

        $this->model->whereIn('id', $ids)->update(['deleted_by' => $actionerId]);

        return $this->model->whereIn('id', $ids)->delete();
    }
    public function bulkForceDelete(array $ids): int //
    {
        return $this->model->withTrashed()->whereIn('id', $ids)->forceDelete();
    }


    /* ================== ================== ==================
    *                  Accessor Methods (Optional)
    * ================== ================== ================== */

    public function getActive(string $sortField = 'created_at', $order = 'desc'): Collection
    {
        return $this->model->active()->orderBy($sortField, $order)->get();
    }

    public function getInactive(string $sortField = 'created_at', $order = 'desc'): Collection
    {
        return $this->model->inactive()->orderBy($sortField, $order)->get();
    }


    public function getPending(string $sortField = 'created_at', $order = 'desc'): Collection
    {
        return $this->model->pending()->orderBy($sortField, $order)->get();
    }
}
