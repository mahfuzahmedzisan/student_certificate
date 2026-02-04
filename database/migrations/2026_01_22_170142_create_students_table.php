<?php

use App\Enums\StudentStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Traits\AuditColumnsTrait;

return new class extends Migration
{

    use AuditColumnsTrait;
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sort_order')->index()->default(0);
            $table->string('name');
            $table->string('phone')->unique();
            $table->longText('address');
            $table->string('passport_id')->unique();
            $table->string('nominee_name')->nullable();
            $table->string('nominee_number')->nullable();
            $table->string('image')->nullable();
            $table->string('reference_by')->nullable()->index();
            $table->string('reference_contact')->nullable()->index();
            $table->string('status')->index()->default(StudentStatus::ACTIVE->value);
            $table->decimal('payment', 15,2);
            $table->timestamps();
            $table->softDeletes();
            $this->addAdminAuditColumns($table);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
