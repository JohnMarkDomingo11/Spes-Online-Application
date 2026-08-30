@extends('layouts.admin')

@section('title', 'Users Management')
@section('page-title', 'Users Management')
@section('page-sub', 'All registered applicant accounts')

@section('content')

<div class="stats-grid" style="margin-bottom:20px;">
    <div class="stat-card">
        <div class="stat-icon blue"><i class="fa-solid fa-users"></i></div>
        <div><div class="stat-num">{{ $totalUsers }}</div><div class="stat-label">Total Registered Users</div></div>
    </div>
</div>

<div class="card">
    <div class="card-header"><h2><i class="fa-solid fa-users"></i> Registered Users</h2></div>
    <div class="card-body">
        @if($users->isEmpty())
            <p style="color:var(--text-muted);text-align:center;padding:40px 0;">No users registered yet.</p>
        @else
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Application Status</th>
                        <th>Registered</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $i => $user)
                    <tr>
                        <td style="color:var(--text-muted)">{{ $users->firstItem() + $i }}</td>
                        <td><strong>{{ $user->name }}</strong></td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @php $app = $user->applications()->first(); @endphp
                            @if($app)
                                <span class="badge badge-{{ $app->status }}">{{ ucfirst($app->status) }}</span>
                                <a href="{{ route('admin.applications.show', $app) }}" class="btn btn-info btn-sm" style="margin-left:6px;">
                                    <i class="fa-solid fa-eye"></i> View
                                </a>
                            @else
                                <span style="color:var(--text-muted);font-size:.82rem;">No application yet</span>
                            @endif
                        </td>
                        <td style="font-size:.78rem;color:var(--text-muted)">{{ $user->created_at->format('M d, Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="pagination">
            {{ $users->links('pagination::simple-bootstrap-4') }}
        </div>
        @endif
    </div>
</div>
@endsection
