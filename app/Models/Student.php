<?php

namespace App\Models;

use App\Enums\StudentStatus;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Scout\Searchable;
use Laravel\Scout\Attributes\SearchUsingPrefix;

class Student extends BaseModel
{
    use  Searchable;

    protected $guard = 'admin';

    protected $fillable = [
        'sort_order',
        'name',
        'status',
        'phone',
        'address',
        'passport_id',
        'image',
        'reference_by',
        'reference_contact',
        'payment',
        'nominee_name',
        'nominee_number',

        'restored_at',
        'created_by',
        'updated_by',
        'deleted_by',
        'restored_by',
    ];


    protected $hidden = [
        'id',
    ];


    protected $casts = [
        'status' => StudentStatus::class,
    ];


    /* =#=#=#=#=#=#=#=#=#=#==#=#=#=#= =#=#=#=#=#=#=#=#=#=#==#=#=#=#=
                Start of RELATIONSHIPS
     =#=#=#=#=#=#=#=#=#=#==#=#=#=#= =#=#=#=#=#=#=#=#=#=#==#=#=#=#= */

    //

    /* =#=#=#=#=#=#=#=#=#=#==#=#=#=#= =#=#=#=#=#=#=#=#=#=#==#=#=#=#=
                End of RELATIONSHIPS
     =#=#=#=#=#=#=#=#=#=#==#=#=#=#= =#=#=#=#=#=#=#=#=#=#==#=#=#=#= */



    /* =#=#=#=#=#=#=#=#=#=#=#==#=#=#=#= =#=#=#=#=#=#=#=#=#=#==#=#=#=#=
    |           Query Scopes                                       |
    =#=#=#=#=#=#=#=#=#=#==#=#=#=#= =#=#=#=#=#=#=#=#=#=#==#=#=#=#=#= */

    public function scopeFilter(Builder $query, array $filters): Builder
    {
        return $query
            ->when(
                $filters['status'] ?? null,
                fn($q, $status) =>
                $q->where('status', $status)
            )
            ->when(
                $filters['name'] ?? null,
                fn($q, $isDefault) =>
                $q->where('name', $isDefault)
            )
            ->when(
                $filters['phone'] ?? null,
                fn($q, $isDefault) =>
                $q->where('phone', $isDefault)
            )
            ->when(
                $filters['passport_id'] ?? null,
                fn($q, $isDefault) =>
                $q->where('passport_id', $isDefault)
            )
            ->when(
                $filters['reference_by'] ?? null,
                fn($q, $isDefault) =>
                $q->where('reference_by', $isDefault)
            )
            ->when(
                $filters['reference_contact'] ?? null,
                fn($q, $isDefault) =>
                $q->where('reference_contact', $isDefault)
            );
    }

    /*  =#=#=#=#=#=#=#=#=#=#=#==#=#=#=#= =#=#=#=#=#=#=#=#=#=#==#=#=#=#=
    |          End of Query Scopes                                   |
    =#=#=#=#=#=#=#=#=#=#==#=#=#=#= =#=#=#=#=#=#=#=#=#=#==#=#=#=#=#= */




    /* =#=#=#=#=#=#=#=#=#=#=#==#=#=#=#= =#=#=#=#=#=#=#=#=#=#==#=#=#=#=
    |          Scout Search Configuration                         |
    =#=#=#=#=#=#=#=#=#=#==#=#=#=#= =#=#=#=#=#=#=#=#=#=#==#=#=#=#=#= */

    #[SearchUsingPrefix(['name', 'phone', 'address', 'passport_id','reference_by','reference_contact','payment'])]
    public function toSearchableArray(): array
    {
        return [
            'name' => $this->name,
            'phone' => $this->phone,
            'address' => $this->address,
            'passport_id' => $this->passport_id,
            'reference_by' => $this->reference_by,
            'reference_contact' => $this->reference_contact,
            'payment' => $this->payment,
        ];
    }

    /**
     * Include only non-deleted data in search index.
     */
    public function shouldBeSearchable(): bool
    {
        return is_null($this->deleted_at);
    }

    /* =#=#=#=#=#=#=#=#=#=#=#==#=#=#=#= =#=#=#=#=#=#=#=#=#=#==#=#=#=#=
    |        End  Scout Search Configuration                                    |
    =#=#=#=#=#=#=#=#=#=#==#=#=#=#= =#=#=#=#=#=#=#=#=#=#==#=#=#=#=#= */




    /* =#=#=#=#=#=#=#=#=#=#=#==#=#=#=#= =#=#=#=#=#=#=#=#=#=#==#=#=#=#=
    |        Attribute Accessors                                    |
    =#=#=#=#=#=#=#=#=#=#==#=#=#=#= =#=#=#=#=#=#=#=#=#=#==#=#=#=#=#= */


    public function getStatusLabelAttribute(): string
    {
        return $this->status->label();
    }

    public function getStatusColorAttribute(): string
    {
        return $this->status->color();
    }


    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->appends = array_merge(parent::getAppends(), [
            'image_url'
        ]);
    }


    public function getImageUrlAttribute(): string
    {
        return storage_url($this->image);
    }

    /* =#=#=#=#=#=#=#=#=#=#=#==#=#=#=#= =#=#=#=#=#=#=#=#=#=#==#=#=#=#=
    |       Methods                                   |
    =#=#=#=#=#=#=#=#=#=#==#=#=#=#= =#=#=#=#=#=#=#=#=#=#==#=#=#=#=#= */

     public function scopeActive($query): Builder
    {
        return $query->where('status', StudentStatus::ACTIVE->value);
    }

    /**
     * Scope a query to only include inactive admins.
     */
    public function scopeInactive($query): Builder
    {
        return $query->where('status', StudentStatus::ACTIVE->value);
    }

    public function isActive(): bool
    {
        return $this->status === StudentStatus::ACTIVE;
    }

    public function activate(): void
    {
        $this->update(['status' => StudentStatus::ACTIVE]);
    }

    public function deactivate(): void
    {
        $this->update(['status' => StudentStatus::ACTIVE]);
    }
}
