<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>User Dashboard — SPES</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --primary: #0b4f2b; --primary-dark: #07321a; --accent: #ffb454;
            --bg: #f3f6f5; --white: #fff; --text: #123; --text-muted: #6b7680;
            --border: #e6eef0; --shadow: 0 6px 18px rgba(16,24,32,.08);
            --sidebar-w: 260px;
        }
        body { font-family: 'Segoe UI', Roboto, Arial, sans-serif; background: var(--bg); color: var(--text); }

        /* Sidebar */
        .sidebar { position: fixed; top:0; left:0; width:var(--sidebar-w); height:100vh;
            background:linear-gradient(180deg,var(--primary) 0%,var(--primary-dark) 100%); display:flex; flex-direction:column; z-index:100; padding-bottom:12px; }
        .sidebar-brand { padding:22px 20px 18px; border-bottom:1px solid rgba(255,255,255,.06);
            display:flex; align-items:center; gap:12px; }
        .sidebar-brand img { width:44px; height:44px; border-radius:8px; object-fit:cover; }
        .sidebar-brand span { font-size:1rem; font-weight:800; color:#fff; line-height:1.1; }
        .sidebar-brand small { display:block; font-size:.72rem; color:rgba(255,255,255,.7); }
        .sidebar-nav { padding:18px 12px; flex:1; }
        .nav-link { display:flex; align-items:center; gap:12px; color:rgba(255,255,255,.95);
            text-decoration:none; padding:14px 16px; border-radius:12px; font-size:1rem;
            transition:background .18s, transform .08s; margin-bottom:10px; }
        .nav-link i { width:18px; text-align:center; }
        .nav-link:hover { background:rgba(255,255,255,.04); transform:translateX(2px); }
        .nav-link.active { background:rgba(255,255,255,.12); box-shadow:none; font-weight:700; color:#fff; }
        .nav-link .fa-solid { color:rgba(255,255,255,.95); }
        .sidebar-user { padding:16px 14px; border-top:1px solid rgba(255,255,255,.04); display:flex; gap:12px; align-items:center; }
        .sidebar-user img { width:46px; height:46px; border-radius:50%; border:2px solid rgba(255,255,255,.08); box-shadow:0 2px 6px rgba(0,0,0,.12); }
        .sidebar-user .meta { color:#fff; }
        .sidebar-user .meta b { display:block; font-size:.98rem; }

        /* Topbar */
        .topbar { position:fixed; top:0; left:var(--sidebar-w); right:0; height:72px;
            background:var(--white); box-shadow:var(--shadow); display:flex; align-items:center;
            justify-content:space-between; padding:0 22px; z-index:90; }
        .topbar .brand { display:flex; align-items:center; gap:12px; }
        .topbar h1 { font-size:1.15rem; font-weight:800; color:var(--primary); }
        .topbar p  { font-size:.78rem; color:var(--text-muted); margin-top:2px; }
        .topbar-right { display:flex; align-items:center; gap:16px; }
        .date-pill { background:#f7fbf9; border:1px solid var(--border); padding:8px 12px; border-radius:10px; color:var(--primary); font-weight:700; }
        .user-pill { display:flex; align-items:center; gap:10px; }
        .user-pill img { width:38px; height:38px; border-radius:50%; }

        /* Main */
        .page-wrapper { margin-left:var(--sidebar-w); padding-top:72px; }
        .page-content  { padding:26px; max-width:1200px; margin:0 auto; }

        /* Cards */
        .card { background:var(--white); border-radius:12px; box-shadow:var(--shadow); overflow:hidden; margin-bottom:20px; }
        .card-header { padding:16px 18px; border-bottom:1px solid var(--border); display:flex; align-items:center; justify-content:space-between; }
        .card-header h2 { font-size:1rem; font-weight:800; color:var(--primary); }
        .card-body { padding:18px; }

        /* Stat cards */
        .stats-row { display:grid; grid-template-columns:repeat(3,1fr); gap:16px; margin-bottom:18px; }
        .stat-card { background:var(--white); border-radius:12px; padding:18px; box-shadow:var(--shadow);
            display:flex; align-items:center; gap:14px; }
        .stat-icon { width:54px; height:54px; border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:1.25rem; flex-shrink:0; }
        .stat-num { font-size:1.6rem; font-weight:800; color:var(--primary); line-height:1; }
        .stat-label { font-size:.78rem; color:var(--text-muted); margin-top:4px; }

        /* Hero / welcome */
        .layout-grid { display:grid; grid-template-columns:2fr 1fr; gap:18px; align-items:start; }
        .hero { display:flex; gap:18px; align-items:center; padding:20px; }
        .hero-ill { width:84px; height:84px; background:#e7f4ee; border-radius:12px; display:flex; align-items:center; justify-content:center; }
        .hero h3 { font-size:1.15rem; color:var(--primary); margin-bottom:6px; }
        .hero p { color:var(--text-muted); }
        .quick-actions { display:grid; grid-template-columns:repeat(3,1fr); gap:10px; }
        .qa { padding:12px; border-radius:10px; background:#f6faf8; text-align:center; font-weight:700; color:var(--primary); }

        /* Progress steps horizontal */
        .progress { background:var(--white); padding:18px; border-radius:12px; box-shadow:var(--shadow); }
        .progress-track { display:flex; gap:12px; align-items:center; justify-content:space-between; }
        .progress-step { flex:1; display:flex; align-items:center; gap:10px; }
        .progress-step .dot { width:36px; height:36px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-weight:800; color:#fff; background:#d6eedd; }
        .progress-step.active .dot { background:var(--primary); }

        /* How to Apply list */
        .how-list { display:flex; flex-direction:column; gap:10px; }
        .how-item { background:#fff; border-radius:10px; padding:12px; border:1px solid var(--border); display:flex; gap:12px; align-items:flex-start; }
        .how-item .num { width:34px; height:34px; border-radius:50%; background:var(--primary); color:#fff; display:flex; align-items:center; justify-content:center; font-weight:800; }

        /* Misc */
        .btn { display:inline-flex; align-items:center; gap:8px; padding:10px 16px; border-radius:8px; font-size:.9rem; font-weight:700; border:none; cursor:pointer; text-decoration:none; }
        .btn-primary { background:var(--primary); color:#fff; }
        .btn-outline { background:transparent; border:1.5px solid var(--primary); color:var(--primary); }

        .hamburger { display:none; background:none; border:none; font-size:1.2rem; cursor:pointer; color:var(--primary); margin-right:10px; }
        @media(max-width:900px) { .hamburger { display:block; } }

        /* Sidebar logout button */
        .sidebar-footer { padding:12px; }
        .btn-logout { display:inline-flex; align-items:center; gap:8px; padding:8px 10px; border-radius:8px; background:#fff; color:var(--primary-dark); border:1px solid rgba(0,0,0,.08); font-weight:700; box-shadow:0 2px 6px rgba(0,0,0,.06); }
        .btn-logout i { color:var(--primary-dark); }
        .btn-logout:hover { transform:translateY(-1px); }

        @media(max-width:900px) {
            .layout-grid { grid-template-columns:1fr; }
            .stats-row { grid-template-columns:repeat(auto-fit,minmax(180px,1fr)); }
            .topbar { left:0; }
            .page-wrapper { margin-left:0; padding-top:72px; }
            .sidebar { transform:translateX(-100%); transition:transform .24s; }
            .sidebar.open { transform:translateX(0); }
        }
    </style>
</head>
<body>

<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <img src="{{ asset('images/spes.logo.jpg') }}" alt="SPES">
        <div><span>SPES Portal<small>PESO Camalaniugan</small></span></div>
    </div>
    <nav class="sidebar-nav">
        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="fa-solid fa-house"></i> Dashboard
        </a>
        <a href="{{ route('applications.myApplication') }}" class="nav-link {{ request()->routeIs('applications.myApplication') ? 'active' : '' }}">
            <i class="fa-solid fa-file-lines"></i> My Application
        </a>
        <a href="{{ route('profile.edit') }}" class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
            <i class="fa-solid fa-user-pen"></i> Edit Profile
        </a>
        @if(!$application)
        <a href="{{ route('applications.create') }}" class="nav-link {{ request()->routeIs('applications.create') ? 'active' : '' }}">
            <i class="fa-solid fa-file-circle-plus"></i> Apply Now
        </a>
        @elseif($application->status === 'denied')
        <a href="{{ route('applications.edit') }}" class="nav-link {{ request()->routeIs('applications.edit') ? 'active' : '' }}">
            <i class="fa-solid fa-rotate-right"></i> Reapply
        </a>
        @endif
    </nav>
    <div class="sidebar-user">
        <img src="{{ Auth::user()->profile_photo_url ?? asset('images/avatar.png') }}" alt="{{ Auth::user()->name }}">
        <div class="meta">
            <b>{{ Auth::user()->name }}</b>
            <small style="color:rgba(255,255,255,.8);">Student Applicant</small>
        </div>
    </div>
    <div class="sidebar-footer" style="padding:10px 12px;">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout"><i class="fa-solid fa-right-from-bracket"></i> Log Out</button>
        </form>
    </div>
</aside>

<header class="topbar">
    <div class="brand" style="display:flex;align-items:center;">
        <button class="hamburger" onclick="document.getElementById('sidebar').classList.toggle('open')"><i class="fa-solid fa-bars"></i></button>
        <div>
            <h1>Welcome back, {{ explode(' ', Auth::user()->name)[0] }}!</h1>
            <p>SPES Applicant Portal</p>
        </div>
    </div>
    <div class="topbar-right">
        <div class="notif">
            <div class="bell" id="notifBellUser" title="Notifications">
                <i class="fa-solid fa-bell" style="color:var(--primary);"></i>
                @php $unread_u = auth()->user()->unreadNotifications->count(); @endphp
                @if($unread_u > 0)
                    <div class="count" id="notifCountUser">{{ $unread_u }}</div>
                @endif
            </div>
            <div class="notif-dropdown" id="notifDropdownUser">
                @php $notes_u = auth()->user()->unreadNotifications->take(8); @endphp
                @if($notes_u->count())
                    @foreach($notes_u as $n)
                        <div class="notif-item" data-id="{{ $n->id }}">
                            <div style="width:36px;height:36px;border-radius:8px;background:#eef7ff;display:flex;align-items:center;justify-content:center;"><i class="fa-solid fa-info" style="color:#1e6fb3"></i></div>
                            <div class="meta">
                                <div style="font-weight:700;">{{ $n->data['message'] ?? 'Notification' }}</div>
                                <div style="font-size:.8rem;color:#6b7680;margin-top:4px;">{{ optional($n->created_at)->diffForHumans() }}</div>
                            </div>
                        </div>
                    @endforeach
                    <div style="padding:10px;text-align:center;border-top:1px solid #f1f5f6;"><a href="#" id="markAllReadUser" style="color:var(--primary);text-decoration:none;font-weight:700;">Mark all as read</a></div>
                @else
                    <div class="notif-empty">No new notifications</div>
                @endif
            </div>
        </div>
        <div class="user-pill">
            <img src="{{ Auth::user()->profile_photo_url ?? asset('images/avatar.png') }}" alt="User">
            <div style="text-align:left;">
                <div style="font-weight:700;color:var(--primary);">{{ Auth::user()->name }}</div>
                <div style="font-size:.78rem;color:var(--text-muted);">{{ Auth::user()->email }}</div>
            </div>
        </div>
        </div>
<script>
document.addEventListener('DOMContentLoaded', function(){
    const bellU = document.getElementById('notifBellUser');
    const ddU = document.getElementById('notifDropdownUser');
    const markAllU = document.getElementById('markAllReadUser');
    if (bellU) {
        bellU.addEventListener('click', ()=> ddU.classList.toggle('open'));
        document.addEventListener('click', (e)=>{ if (!bellU.contains(e.target) && !ddU.contains(e.target)) ddU.classList.remove('open'); });
    }
    if (markAllU) {
        markAllU.addEventListener('click', function(e){ e.preventDefault(); fetch('{{ route('notifications.readAll') }}', { method: 'POST', headers: {'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content') } }).then(()=>{ document.getElementById('notifCountUser')?.remove(); ddU.innerHTML = '<div class="notif-empty">No new notifications</div>'; }) });
    }
    ddU?.addEventListener('click', function(e){ let item = e.target.closest('.notif-item'); if (!item) return; const id = item.getAttribute('data-id'); fetch('/notifications/'+id+'/read', { method:'POST', headers:{'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content') } }).then(()=> { item.remove(); const cnt = document.getElementById('notifCountUser'); if (cnt) { let v = parseInt(cnt.innerText)-1; if (v<=0) cnt.remove(); else cnt.innerText = v; } }); });
});
</script>
</header>

<div class="page-wrapper">
<div class="page-content">

    @if(session('success'))
        <div class="alert alert-success"><i class="fa-solid fa-circle-check"></i> {{ session('success') }}</div>
    @endif
    @if(session('info'))
        <div class="alert alert-info"><i class="fa-solid fa-circle-info"></i> {{ session('info') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-warning"><i class="fa-solid fa-triangle-exclamation"></i> {{ session('error') }}</div>
    @endif

    {{-- Stats --}}
    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-icon" style="background:#e7f9f1;color:#0b6f45;"><i class="fa-solid fa-file-circle-check"></i></div>
            <div>
                <div class="stat-num">{{ $application ? 1 : 0 }}</div>
                <div class="stat-label">Applications Submitted</div>
                <a href="{{ route('applications.myApplication') }}" style="font-size:.78rem;color:var(--text-muted);text-decoration:none;">View Application →</a>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background:#fff8e6;color:#e07b15;"><i class="fa-solid fa-hourglass-half"></i></div>
            <div>
                <div class="stat-num">
                    @if($application)
                        <span class="badge badge-{{ $application->status }}">{{ ucfirst($application->status) }}</span>
                    @else
                        Not Submitted
                    @endif
                </div>
                <div class="stat-label">Application Status</div>
                <a href="{{ route('applications.create') }}" style="font-size:.78rem;color:var(--text-muted);text-decoration:none;">Apply Now →</a>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background:#eef7ff;color:#1e6fb3;"><i class="fa-solid fa-chart-line"></i></div>
            <div>
                <div class="stat-num">{{ $application ? ($application->progress ?? '100') : '0' }}%</div>
                <div class="stat-label">Application Progress</div>
                <a href="{{ route('applications.myApplication') }}" style="font-size:.78rem;color:var(--text-muted);text-decoration:none;">View Progress →</a>
            </div>
        </div>
    </div>

    <div class="layout-grid">
        <div>
            <div class="card">
                <div class="card-body hero">
                    <div class="hero-ill"><i class="fa-solid fa-clipboard-check" style="font-size:28px;color:var(--primary);"></i></div>
                    <div style="flex:1;">
                        <h3>Welcome back, {{ explode(' ', Auth::user()->name)[0] }}!</h3>
                        <p>Start your SPES application by completing your documents and personal information. We're here to help you every step of the way.</p>
                        <div style="margin-top:12px;"><a href="{{ $application ? route('applications.myApplication') : route('applications.create') }}" class="btn btn-primary">{{ $application ? 'View My Application' : 'Apply Now' }}</a></div>
                    </div>
                    <div style="min-width:150px;display:flex;flex-direction:column;gap:10px;">
                        <div class="qa"><i class="fa-solid fa-paper-plane"></i><div style="font-size:.78rem;margin-top:6px;">Apply Now</div></div>
                        <div class="qa"><i class="fa-solid fa-file-lines"></i><div style="font-size:.78rem;margin-top:6px;">My Application</div></div>
                        <div class="qa"><i class="fa-solid fa-user-pen"></i><div style="font-size:.78rem;margin-top:6px;">Edit Profile</div></div>
                    </div>
                </div>
            </div>

            <div class="card progress" style="margin-top:12px;">
                <div class="card-header"><h2>Application Progress</h2></div>
                <div class="card-body">
                    <div class="progress-track">
                        <div class="progress-step @if(!$application) active @endif">
                            <div class="dot">1</div>
                            <div style="font-size:.9rem;color:var(--text-muted);">Account Created</div>
                        </div>
                        <div class="progress-step @if($application && ($application->profile_completed ?? false)) active @endif">
                            <div class="dot">2</div>
                            <div style="font-size:.9rem;color:var(--text-muted);">Profile Updated</div>
                        </div>
                        <div class="progress-step @if($application && ($application->documents_uploaded ?? false)) active @endif">
                            <div class="dot">3</div>
                            <div style="font-size:.9rem;color:var(--text-muted);">Documents Uploaded</div>
                        </div>
                        <div class="progress-step @if($application && $application->status === 'submitted') active @endif">
                            <div class="dot">4</div>
                            <div style="font-size:.9rem;color:var(--text-muted);">Submitted</div>
                        </div>
                        <div class="progress-step @if($application && in_array($application->status,['approved','for review'])) active @endif">
                            <div class="dot">5</div>
                            <div style="font-size:.9rem;color:var(--text-muted);">For Review</div>
                        </div>
                    </div>
                    <div style="margin-top:12px;color:var(--text-muted);">You haven't submitted a SPES application yet. Click "Apply Now" to get started.</div>
                </div>
            </div>
        </div>

        <div>
            <div class="card">
                <div class="card-header"><h2>Quick Actions</h2></div>
                <div class="card-body">
                    <div class="quick-actions">
                        <a class="qa" href="{{ route('applications.create') }}"><i class="fa-solid fa-paper-plane"></i><div style="font-size:.82rem;margin-top:6px;">Apply Now</div></a>
                        <a class="qa" href="{{ route('applications.myApplication') }}"><i class="fa-solid fa-file-lines"></i><div style="font-size:.82rem;margin-top:6px;">My Application</div></a>
                        <a class="qa" href="{{ route('profile.edit') }}"><i class="fa-solid fa-user-pen"></i><div style="font-size:.82rem;margin-top:6px;">Edit Profile</div></a>
                    </div>
                </div>
            </div>

            <div class="card" style="margin-top:12px;">
                <div class="card-header"><h2>How to Apply</h2></div>
                <div class="card-body">
                    <div class="how-list">
                        <div class="how-item"><div class="num">1</div><div><b>Prepare Your Documents</b><div style="color:var(--text-muted);font-size:.9rem;">Gather your Resume, Application Letter, and Certificate of Indigency.</div></div></div>
                        <div class="how-item"><div class="num">2</div><div><b>Fill Out the Form</b><div style="color:var(--text-muted);font-size:.9rem;">Click "Apply Now" and complete all required fields.</div></div></div>
                        <div class="how-item"><div class="num">3</div><div><b>Upload Documents</b><div style="color:var(--text-muted);font-size:.9rem;">Upload clear scanned copies (PDF, JPG, PNG).</div></div></div>
                        <div class="how-item"><div class="num">4</div><div><b>Submit & Wait</b><div style="color:var(--text-muted);font-size:.9rem;">The PESO officer will review your application.</div></div></div>
                        <div class="how-item"><div class="num">5</div><div><b>Check Feedback</b><div style="color:var(--text-muted);font-size:.9rem;">Review any admin comments in "My Application".</div></div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</div>

{{-- Footer --}}
<footer style="margin-left:var(--sidebar-w);background:#fff;border-top:1px solid var(--border);padding:14px 24px;font-size:.78rem;color:var(--text-muted);display:flex;justify-content:space-between;flex-wrap:wrap;gap:8px;">
    <span>&copy; {{ date('Y') }} SPES Management System — PESO Camalaniugan</span>
    <span>
        <a href="https://www.facebook.com" target="_blank" style="color:var(--primary);text-decoration:none;margin-right:14px;"><i class="fa-brands fa-facebook"></i> Facebook</a>
        <a href="mailto:pesocamalaniugan@gmail.com" style="color:var(--primary);text-decoration:none;"><i class="fa-solid fa-envelope"></i> pesocamalaniugan@gmail.com</a>
    </span>
</footer>
</body>
</html>
