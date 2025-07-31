<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Projects Report - {{ date('Y-m-d') }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #ccc;
            padding-bottom: 20px;
        }
        .company-info {
            margin-bottom: 10px;
        }
        .report-title {
            font-size: 24px;
            font-weight: bold;
            margin: 10px 0;
        }
        .report-date {
            font-size: 14px;
            color: #666;
        }
        .summary {
            margin: 20px 0;
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
        }
        .summary-grid {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .summary-item {
            text-align: center;
            flex: 1;
        }
        .summary-label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        .summary-value {
            font-size: 18px;
            font-weight: bold;
            color: #007bff;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }
        th {
            background-color: #f8f9fa;
            font-weight: bold;
            font-size: 11px;
        }
        td {
            font-size: 10px;
        }
        .status {
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 9px;
            font-weight: bold;
            text-align: center;
        }
        .status-approved { background-color: #d4edda; color: #155724; }
        .status-rejected { background-color: #f8d7da; color: #721c24; }
        .status-pending_approval { background-color: #fff3cd; color: #856404; }
        .status-completed { background-color: #d1ecf1; color: #0c5460; }
        .status-in_progress { background-color: #e2e3f1; color: #383d41; }
        .status-pending { background-color: #f1f3f4; color: #495057; }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }
        .page-break {
            page-break-before: always;
        }
        .project-details {
            margin-bottom: 5px;
        }
        .approval-info {
            font-size: 9px;
            line-height: 1.2;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="company-info">
            <h2>PT Smart ISP</h2>
            <p>Internet Service Provider & Technology Solutions</p>
        </div>
        <div class="report-title">Projects Report</div>
        <div class="report-date">Generated on {{ date('d F Y H:i:s') }}</div>
        @if($user->role !== 'admin' && $user->role !== 'manager')
        <div class="report-date">Sales Person: {{ $user->name }}</div>
        @endif
    </div>

    <div class="summary">
        <h3>Summary</h3>
        <div class="summary-grid">
            <div class="summary-item">
                <span class="summary-label">Total Projects</span>
                <span class="summary-value">{{ $projects->count() }}</span>
            </div>
            <div class="summary-item">
                <span class="summary-label">Approved</span>
                <span class="summary-value">{{ $projects->where('status', 'approved')->count() }}</span>
            </div>
            <div class="summary-item">
                <span class="summary-label">Pending Approval</span>
                <span class="summary-value">{{ $projects->where('status', 'pending_approval')->count() }}</span>
            </div>
            <div class="summary-item">
                <span class="summary-label">Total Value</span>
                <span class="summary-value">Rp {{ number_format($projects->sum('project_value'), 0, ',', '.') }}</span>
            </div>
        </div>
        
        <div class="summary-grid" style="margin-top: 15px;">
            <div class="summary-item">
                <span class="summary-label">Rejected</span>
                <span class="summary-value">{{ $projects->where('status', 'rejected')->count() }}</span>
            </div>
            <div class="summary-item">
                <span class="summary-label">Completed</span>
                <span class="summary-value">{{ $projects->where('status', 'completed')->count() }}</span>
            </div>
            <div class="summary-item">
                <span class="summary-label">In Progress</span>
                <span class="summary-value">{{ $projects->where('status', 'in_progress')->count() }}</span>
            </div>
            <div class="summary-item">
                <span class="summary-label">Pending</span>
                <span class="summary-value">{{ $projects->where('status', 'pending')->count() }}</span>
            </div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th width="12%">Project Code</th>
                <th width="18%">Lead/Customer</th>
                <th width="15%">Product</th>
                <th width="12%">Sales Person</th>
                <th width="10%">Value</th>
                <th width="8%">Status</th>
                <th width="25%">Details & Approval Info</th>
            </tr>
        </thead>
        <tbody>
            @forelse($projects as $project)
            <tr>
                <td>
                    <div class="project-details">
                        <strong>{{ $project->project_code }}</strong><br>
                        Duration: {{ $project->contract_duration_months }} months
                        @if($project->expected_close_date)
                        <br>Expected: {{ $project->expected_close_date->format('d M Y') }}
                        @endif
                    </div>
                </td>
                <td>
                    @if($project->lead)
                    <div class="project-details">
                        <strong>{{ $project->lead->name }}</strong><br>
                        {{ $project->lead->email }}<br>
                        @if($project->lead->company)
                        {{ $project->lead->company }}<br>
                        @endif
                        {{ $project->lead->phone }}
                    </div>
                    @endif
                </td>
                <td>
                    @if($project->product)
                    <div class="project-details">
                        <strong>{{ $project->product->name }}</strong><br>
                        Type: {{ $project->product->type }}<br>
                        Price: Rp {{ number_format($project->product->price, 0, ',', '.') }}
                    </div>
                    @endif
                </td>
                <td>
                    @if($project->assignedSales)
                    <div class="project-details">
                        <strong>{{ $project->assignedSales->name }}</strong><br>
                        {{ $project->assignedSales->email }}
                    </div>
                    @endif
                </td>
                <td>
                    <strong>Rp {{ number_format($project->project_value, 0, ',', '.') }}</strong>
                </td>
                <td>
                    <span class="status status-{{ $project->status }}">
                        {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                    </span>
                </td>
                <td>
                    <div class="approval-info">
                        @if($project->description)
                        <strong>Description:</strong><br>
                        {{ Str::limit($project->description, 100) }}<br><br>
                        @endif

                        @if($project->status === 'approved' && $project->approvedBy)
                        <strong>✅ Approved by:</strong> {{ $project->approvedBy->name }}<br>
                        <strong>Date:</strong> {{ $project->approved_at->format('d M Y H:i') }}<br>
                        @if($project->manager_notes)
                        <strong>Notes:</strong> {{ $project->manager_notes }}<br>
                        @endif
                        @elseif($project->status === 'rejected' && $project->rejectedBy)
                        <strong>❌ Rejected by:</strong> {{ $project->rejectedBy->name }}<br>
                        <strong>Date:</strong> {{ $project->rejected_at->format('d M Y H:i') }}<br>
                        @if($project->rejection_reason)
                        <strong>Reason:</strong> {{ $project->rejection_reason }}<br>
                        @endif
                        @if($project->manager_notes)
                        <strong>Notes:</strong> {{ $project->manager_notes }}<br>
                        @endif
                        @elseif($project->status === 'pending_approval')
                        <strong>⏳ Awaiting manager approval</strong><br>
                        Created: {{ $project->created_at->format('d M Y H:i') }}
                        @elseif($project->status === 'completed' && $project->installation_date)
                        <strong>✅ Completed</strong><br>
                        Installation: {{ $project->installation_date->format('d M Y') }}
                        @endif

                        @if($project->sales_notes)
                        <br><strong>Sales Notes:</strong> {{ Str::limit($project->sales_notes, 80) }}
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: center; padding: 20px;">
                    No projects found.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>This report was generated automatically by PT Smart ISP CRM System</p>
        <p>Report contains {{ $projects->count() }} projects with total value of Rp {{ number_format($projects->sum('project_value'), 0, ',', '.') }}</p>
        <p>Generated on {{ date('d F Y H:i:s T') }} by {{ $user->name }} ({{ $user->role }})</p>
    </div>
</body>
</html>
