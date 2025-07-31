<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_code',
        'name',
        'email',
        'phone',
        'address',
        'company',
        'status',
        'project_id',
        'sales_person_id',
        'service_start_date',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'service_start_date' => 'datetime',
        ];
    }

    // Relationships
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function salesPerson()
    {
        return $this->belongsTo(User::class, 'sales_person_id');
    }

    public function customerProducts()
    {
        return $this->hasMany(CustomerProduct::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'customer_products')
                    ->withPivot('status', 'monthly_fee', 'service_start_date', 'service_end_date', 'installation_notes')
                    ->withTimestamps();
    }

    public function activeProducts()
    {
        return $this->belongsToMany(Product::class, 'customer_products')
                    ->wherePivot('status', 'active')
                    ->withPivot('status', 'monthly_fee', 'service_start_date', 'service_end_date', 'installation_notes')
                    ->withTimestamps();
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeBySalesPerson($query, $salesPersonId)
    {
        return $query->where('sales_person_id', $salesPersonId);
    }

    // Accessors
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'active' => 'badge-success',
            'suspended' => 'badge-warning',
            'terminated' => 'badge-danger',
        ];

        return $badges[$this->status] ?? 'badge-light';
    }

    public function getTotalMonthlyFeeAttribute()
    {
        return $this->customerProducts->where('status', 'active')->sum('monthly_fee');
    }

    public function getFormattedTotalMonthlyFeeAttribute()
    {
        return 'Rp ' . number_format($this->total_monthly_fee, 0, ',', '.');
    }
}
