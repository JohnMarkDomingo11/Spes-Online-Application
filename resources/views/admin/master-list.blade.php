@extends('layouts.admin')

@section('title', 'Master List')
@section('page-title', 'Approved Applicants Master List')
@section('page-sub', 'Review, filter, and finalize the approved SPES beneficiaries list')

@section('content')

<div class="card">
    <div class="card-header">
        <h2><i class="fa-solid fa-list-check"></i> Approved Applicants</h2>
    </div>
    <div class="card-body">
        {{-- Filters --}}
        <div style="display: flex; gap: 12px; align-items: center; margin-bottom: 20px; flex-wrap: wrap;">
            <form method="GET" class="search-bar" style="margin-bottom: 0; flex: 1; min-width: 300px;">
                <select name="barangay">
                    <option value="">All Barangay</option>
                    @foreach(['Abagao','Alaguia','Bagumbayan','Bangag','Bical','Bicud','Binag','Cabayabasan (Capacuan)','Cagoran','Cambong','Catayauan','Catugan','Centro (Poblacion)','Cullit','Dagupan','Dalaya','Fabrica','Fusina','Jurisdiction','Lalafugan','Logac','Magallungon (Santa Teresa)','Magapit','Malanao','Maxingal','Naguilian','Paranum','Rosario','San Antonio (Lafu)','San Jose','San Juan','San Lorenzo','San Mariano','Santa Maria','Tucalana'] as $b)
                        <option value="{{ $b }}" {{ request('barangay')===$b ? 'selected':'' }}>{{ $b }}</option>
                    @endforeach
                </select>
                <select name="spes_status">
                    <option value="">All SPES Type</option>
                    <option value="new" {{ request('spes_status')==='new' ? 'selected':'' }}>New</option>
                    <option value="baby" {{ request('spes_status')==='baby' ? 'selected':'' }}>SPES Baby</option>
                </select>
                <select name="sort">
                    <option value="name_asc" {{ request('sort', 'name_asc')==='name_asc' ? 'selected':'' }}>Name (A-Z)</option>
                    <option value="name_desc" {{ request('sort')==='name_desc' ? 'selected':'' }}>Name (Z-A)</option>
                </select>
                <button type="submit" class="btn btn-primary btn-sm"><i class="fa-solid fa-filter"></i> Filter</button>
                <a href="{{ route('admin.masterlist.index') }}" class="btn btn-outline btn-sm">Clear</a>
            </form>
            <a href="{{ route('admin.applications.export', array_merge(['status' => 'approved'], request()->query())) }}" class="btn btn-primary btn-sm" style="white-space: nowrap;">
                <i class="fa-solid fa-file-excel"></i> Export Excel
            </a>
        </div>

        @if($applications->isEmpty())
            <p style="color:var(--text-muted);text-align:center;padding:40px 0;">No approved applications match the filters.</p>
        @else
        <div style="margin-bottom: 20px;">
            <strong>Total Count:</strong> <span style="color: var(--primary); font-size: 1.1rem;">{{ $applications->total() }}</span>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Full Name</th>
                        <th>Barangay</th>
                        <th>SPES Type</th>
                        <th>Age</th>
                        <th>Contact</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($applications as $i => $app)
                    <tr>
                        <td style="color:var(--text-muted)">{{ $applications->firstItem() + $i }}</td>
                        <td><strong>{{ $app->full_name }}</strong></td>
                        <td>{{ $app->barangay }}</td>
                        <td>
                            <span class="badge {{ $app->spes_status === 'new' ? 'badge-new' : 'badge-baby' }}">
                                {{ $app->spes_status === 'new' ? 'New' : 'SPES Baby' }}
                            </span>
                        </td>
                        <td>{{ $app->age }}</td>
                        <td style="font-size:.78rem;">{{ $app->contact_no }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div style="margin-top: 20px; display: flex; justify-content: center;">
            {{ $applications->links() }}
        </div>

        {{-- Save Master List Form --}}
        @if($applications->count() > 0)
        <div style="margin-top: 24px; padding-top: 20px; border-top: 1px solid var(--border);">
            <form method="POST" action="{{ route('admin.masterlist.store') }}" style="display: flex; gap: 12px; align-items: flex-end;">
                @csrf
                
                {{-- Preserve filters in hidden inputs --}}
                <input type="hidden" name="barangay" value="{{ request('barangay') }}">
                <input type="hidden" name="spes_status" value="{{ request('spes_status') }}">
                <input type="hidden" name="sort" value="{{ request('sort', 'name_asc') }}">
                
                <div style="flex: 1;">
                    <label style="display: block; font-weight: 600; margin-bottom: 6px; color: var(--text); font-size: .9rem;">
                        Master List Name (Optional)
                    </label>
                    <input type="text" 
                           name="name"
                           placeholder="e.g., Summer 2026 Batch 1"
                           style="width: 100%; padding: 10px 13px; border: 1.5px solid var(--border); border-radius: 7px; font-size: .95rem;">
                </div>

                <button type="submit" class="btn btn-success" style="display: flex; align-items: center; gap: 6px; white-space: nowrap;">
                    <i class="fa-solid fa-floppy-disk"></i> Save Master List
                </button>
            </form>
        </div>
        @endif
        @endif
    </div>
</div>

<style>
    .badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: .8rem;
        font-weight: 600;
        text-align: center;
    }

    .badge-new {
        background: #e3f2fd;
        color: #1565c0;
    }

    .badge-baby {
        background: #f3e5f5;
        color: #6a1b9a;
    }

    .badge-approved {
        background: #e8f5e9;
        color: #2e7d32;
    }

    .badge-denied {
        background: #ffebee;
        color: #c62828;
    }

    .badge-pending {
        background: #fff3e0;
        color: #e65100;
    }
</style>

@endsection
