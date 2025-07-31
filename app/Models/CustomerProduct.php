<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'product_id',
        'status',
        'monthly_fee',
        'service_start_date',
        'service_end_date',
        'installation_notes',
    ];

    protected function casts(): array
    {
        return [
            'monthly_fee' => 'decimal:2',
            'service_start_date' => 'datetime',
            'service_end_date' => 'datetime',
        ];
    }

    // Relationships
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
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

    public function getFormattedMonthlyFeeAttribute()
    {
        return 'Rp ' . number_format($this->monthly_fee, 0, ',', '.');
    }

    // Helper methods
    public function isActive()
    {
        return $this->status === 'active';
    }

    public function suspend()
    {
        $this->update(['status' => 'suspended']);
    }

    public function terminate()
    {
        $this->update([
            'status' => 'terminated',
            'service_end_date' => now()
        ]);
    }

    public function reactivate()
    {
        $this->update([
            'status' => 'active',
            'service_end_date' => null
        ]);
    }
}
