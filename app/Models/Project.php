<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_code',
        'lead_id',
        'product_id',
        'customer_id',
        'assigned_sales_id',
        'status',
        'project_value',
        'contract_duration_months',
        'description',
        'expected_close_date',
        'sales_notes',
        'manager_notes',
        'approved_by',
        'approved_at',
        'rejected_by',
        'rejected_at',
        'rejection_reason',
        'installation_date',
    ];

    protected function casts(): array
    {
        return [
            'project_value' => 'decimal:2',
            'contract_duration_months' => 'integer',
            'expected_close_date' => 'date',
            'approved_at' => 'datetime',
            'rejected_at' => 'datetime',
            'installation_date' => 'datetime',
        ];
    }

    // Relationships
    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function assignedSales()
    {
        return $this->belongsTo(User::class, 'assigned_sales_id');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function rejectedBy()
    {
        return $this->belongsTo(User::class, 'rejected_by');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Scopes
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopePendingApproval($query)
    {
        return $query->where('status', 'pending_approval');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeBySales($query, $salesId)
    {
        return $query->where('assigned_sales_id', $salesId);
    }

    // Accessors
    public function getFormattedProjectValueAttribute()
    {
        return 'Rp ' . number_format($this->project_value, 0, ',', '.');
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => 'badge-secondary',
            'in_progress' => 'badge-info',
            'pending_approval' => 'badge-warning',
            'approved' => 'badge-success',
            'rejected' => 'badge-danger',
            'completed' => 'badge-primary',
        ];

        return $badges[$this->status] ?? 'badge-light';
    }

    // Helper methods
    public function canApprove()
    {
        return $this->status === 'pending_approval';
    }

    public function isApproved()
    {
        return $this->status === 'approved';
    }

    public function isRejected()
    {
        return $this->status === 'rejected';
    }
}
