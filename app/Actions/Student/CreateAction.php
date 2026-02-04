<?php

namespace App\Actions\Student;


use App\Models\Student;
use App\Repositories\Contracts\StudentRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CreateAction
{
    public function __construct(public StudentRepositoryInterface $interface) {}

    public function execute(array $data): Student
    {
        return DB::transaction(function () use ($data) {

               if ($data['image']) {
                $prefix = uniqid('IMX') . '-' . time() . '-' . uniqid();
                $fileName = $prefix . '-' . $data['image']->getClientOriginalName();
                $data['image'] = Storage::disk('public')->putFileAs('students',  $data['image'], $fileName);
            }

            // Create user
            $model = $this->interface->create($data);

            return $model->fresh();
        });
    }
}
