<?php


namespace App\Actions\Student;

use App\Repositories\Contracts\StudentRepositoryInterface;
use Illuminate\Support\Facades\DB;

class RestoreAction
{
  public function __construct(public StudentRepositoryInterface $interface) {}

  public function execute(int $id, ?int $actionerId)
  {
    return DB::transaction(function () use ($id, $actionerId) {
      return $this->interface->restore($id, $actionerId);
    });
  }
}
