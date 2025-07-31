<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Leads Report - PT Smart ISP CRM</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #2563eb;
            padding-bottom: 20px;
        }
        
        .company-name {
            font-size: 24px;
            font-weight: bold;
            color: #1e40af;
            margin-bottom: 5px;
        }
        
        .report-title {
            font-size: 18px;
            color: #374151;
            margin-bottom: 10px;
        }
        
        .report-info {
            font-size: 10px;
            color: #6b7280;
        }
        
        .stats-section {
            margin-bottom: 25px;
            background-color: #f8fafc;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
        }
        
        .stats-grid {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        
        .stat-item {
            text-align: center;
            padding: 10px;
            margin: 5px;
            background-color: #ffffff;
            border-radius: 6px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            min-width: 120px;
            border: 1px solid #d1d5db;
        }
        
        .stat-value {
            font-size: 16px;
            font-weight: bold;
            color: #1f2937;
        }
        
        .stat-label {
            font-size: 10px;
            color: #6b7280;
            text-transform: uppercase;
            margin-top: 2px;
        }
        
        .leads-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 10px;
        }
        
        .leads-table th {
            background-color: #1f2937;
            color: #ffffff;
            padding: 8px 4px;
            text-align: left;
            font-weight: bold;
            font-size: 9px;
            text-transform: uppercase;
        }
        
        .leads-table td {
            padding: 6px 4px;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: top;
            color: #1f2937;
        }
        
        .leads-table tr:nth-child(even) {
            background-color: #f8fafc;
        }
        
        .leads-table tr:nth-child(odd) {
            background-color: #ffffff;
        }
        
        .leads-table tr:hover {
            background-color: #f3f4f6;
        }
        
        .status-badge {
            padding: 2px 6px;
            border-radius: 12px;
            font-size: 8px;
            font-weight: bold;
            text-transform: uppercase;
        }
        
        .status-new { background-color: #dbeafe; color: #1e40af; }
        .status-contacted { background-color: #ddd6fe; color: #5b21b6; }
        .status-qualified { background-color: #dcfce7; color: #166534; }
        .status-proposal { background-color: #fef3c7; color: #92400e; }
        .status-negotiation { background-color: #fed7aa; color: #9a3412; }
        .status-closed-won { background-color: #bbf7d0; color: #14532d; }
        .status-closed-lost { background-color: #fecaca; color: #991b1b; }
        
        .priority-badge {
            padding: 2px 6px;
            border-radius: 12px;
            font-size: 8px;
            font-weight: bold;
            text-transform: uppercase;
        }
        
        .priority-high { background-color: #fecaca; color: #991b1b; }
        .priority-medium { background-color: #fef3c7; color: #92400e; }
        .priority-low { background-color: #dcfce7; color: #166534; }
        
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #6b7280;
            border-top: 1px solid #e5e7eb;
            padding-top: 15px;
        }
        
        .text-truncate {
            max-width: 80px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        
        .currency {
            text-align: right;
            font-weight: bold;
        }
        
        .no-data {
            text-align: center;
            color: #6b7280;
            font-style: italic;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="company-name">PT Smart ISP</div>
        <div class="report-title">All Leads Report</div>
        <div class="report-info">
            Generated on {{ $download_date }} by {{ $user->name }} ({{ ucfirst($user->role) }})
        </div>
    </div>

    <div class="stats-section">
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-value">{{ number_format($total_leads) }}</div>
                <div class="stat-label">Total Leads</div>
            </div>
            <div class="stat-item">
                <div class="stat-value">{{ number_format($qualified_leads) }}</div>
                <div class="stat-label">Qualified</div>
            </div>
            <div class="stat-item">
                <div class="stat-value">{{ number_format($new_leads) }}</div>
                <div class="stat-label">New Leads</div>
            </div>
            <div class="stat-item">
                <div class="stat-value">Rp {{ number_format($total_value, 0, ',', '.') }}</div>
                <div class="stat-label">Total Value</div>
            </div>
        </div>
    </div>

    @if($leads->count() > 0)
    <table class="leads-table">
        <thead>
            <tr>
                <th style="width: 12%;">Lead Name</th>
                <th style="width: 10%;">Contact</th>
                <th style="width: 10%;">Company</th>
                <th style="width: 10%;">Assigned To</th>
                <th style="width: 8%;">Status</th>
                <th style="width: 6%;">Priority</th>
                <th style="width: 10%;">Value</th>
                <th style="width: 8%;">Source</th>
                <th style="width: 8%;">Created</th>
                <th style="width: 18%;">Notes</th>
            </tr>
        </thead>
        <tbody>
            @foreach($leads as $lead)
            <tr>
                <td>
                    <strong style="color: #1f2937;">{{ $lead->name }}</strong>
                    @if($lead->email)
                    <br><small style="color: #4b5563;">{{ $lead->email }}</small>
                    @endif
                </td>
                <td style="color: #1f2937;">
                    @if($lead->phone)
                    {{ $lead->phone }}
                    @else
                    <span style="color: #6b7280;">-</span>
                    @endif
                </td>
                <td>
                    @if($lead->company)
                    <strong style="color: #1f2937;">{{ $lead->company }}</strong>
                    @if($lead->address)
                    <br><small style="color: #4b5563;">{{ Str::limit($lead->address, 30) }}</small>
                    @endif
                    @else
                    <span style="color: #6b7280;">-</span>
                    @endif
                </td>
                <td>
                    @if($lead->assignedUser)
                    <strong style="color: #1f2937;">{{ $lead->assignedUser->name }}</strong>
                    <br><small style="color: #4b5563;">{{ $lead->assignedUser->email }}</small>
                    @else
                    <span style="color: #6b7280;">Unassigned</span>
                    @endif
                </td>
                <td>
                    <span class="status-badge status-{{ str_replace('_', '-', $lead->status) }}">
                        {{ ucfirst(str_replace('_', ' ', $lead->status)) }}
                    </span>
                </td>
                <td>
                    <span class="priority-badge priority-{{ $lead->priority }}">
                        {{ ucfirst($lead->priority) }}
                    </span>
                </td>
                <td class="currency" style="color: #1f2937;">
                    @if($lead->estimated_value)
                    Rp {{ number_format($lead->estimated_value, 0, ',', '.') }}
                    @else
                    <span style="color: #6b7280;">-</span>
                    @endif
                </td>
                <td style="color: #1f2937;">{{ ucfirst($lead->source) }}</td>
                <td style="color: #1f2937;">{{ $lead->created_at->format('d/m/Y') }}</td>
                <td class="text-truncate" style="color: #1f2937;">
                    @if($lead->notes)
                    {{ Str::limit($lead->notes, 60) }}
                    @else
                    <span style="color: #6b7280;">-</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="no-data">
        No leads found for the selected criteria.
    </div>
    @endif

    <div class="footer">
        <p>PT Smart ISP - Customer Relationship Management System</p>
        <p>This report contains confidential information. Please handle with care.</p>
    </div>
</body>
</html>
