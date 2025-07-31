<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'company',
        'status',
        'priority',
        'notes',
        'estimated_value',
        'assigned_to',
        'last_contacted_at',
        'source',
    ];

    protected function casts(): array
    {
        return [
            'estimated_value' => 'decimal:2',
            'last_contacted_at' => 'datetime',
        ];
    }

    // Relationships
    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function customer()
    {
        return $this->hasOneThrough(Customer::class, Project::class);
    }

    // Scopes
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeByPriority($query, $priority)
    {
        return $query->where('priority', $priority);
    }

    public function scopeAssignedTo($query, $userId)
    {
        return $query->where('assigned_to', $userId);
    }

    // Accessors
    public function getFormattedEstimatedValueAttribute()
    {
        return $this->estimated_value ? 'Rp ' . number_format($this->estimated_value, 0, ',', '.') : '-';
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'new' => 'badge-primary',
            'contacted' => 'badge-info',
            'qualified' => 'badge-warning',
            'proposal' => 'badge-secondary',
            'negotiation' => 'badge-dark',
            'closed_won' => 'badge-success',
            'closed_lost' => 'badge-danger',
        ];

        return $badges[$this->status] ?? 'badge-light';
    }

    public function getPriorityBadgeAttribute()
    {
        $badges = [
            'low' => 'badge-light',
            'medium' => 'badge-warning',
            'high' => 'badge-danger',
            'urgent' => 'badge-dark',
        ];

        return $badges[$this->priority] ?? 'badge-light';
    }
}
