<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'title',
        'message',
        'data',
        'is_read',
        'read_at',
    ];

    protected function casts(): array
    {
        return [
            'data' => 'array',
            'is_read' => 'boolean',
            'read_at' => 'datetime',
        ];
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scopes
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    public function scopeRead($query)
    {
        return $query->where('is_read', true);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeRecent($query, $days = 30)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    // Methods
    public function markAsRead()
    {
        $this->update([
            'is_read' => true,
            'read_at' => now(),
        ]);
    }

    public function markAsUnread()
    {
        $this->update([
            'is_read' => false,
            'read_at' => null,
        ]);
    }

    // Accessors
    public function getTypeBadgeAttribute()
    {
        $badges = [
            'approval_request' => 'badge-warning',
            'project_approved' => 'badge-success',
            'project_rejected' => 'badge-danger',
            'project_status' => 'badge-info',
            'lead_assigned' => 'badge-primary',
            'customer_created' => 'badge-success',
        ];

        return $badges[$this->type] ?? 'badge-secondary';
    }

    // Static methods
    public static function createForUser($userId, $type, $title, $message, $data = null)
    {
        return static::create([
            'user_id' => $userId,
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'data' => $data,
        ]);
    }

    public static function createApprovalRequest($managerId, $project)
    {
        return static::createForUser(
            $managerId,
            'approval_request',
            'New Project Approval Request',
            "Project {$project->project_code} needs your approval",
            ['project_id' => $project->id]
        );
    }

    public static function createProjectStatusUpdate($userId, $project, $status)
    {
        $statusText = [
            'approved' => 'approved',
            'rejected' => 'rejected',
            'completed' => 'completed',
        ];

        return static::createForUser(
            $userId,
            'project_status',
            'Project Status Update',
            "Project {$project->project_code} has been {$statusText[$status]}",
            ['project_id' => $project->id, 'status' => $status]
        );
    }
}
