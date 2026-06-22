@extends(admin_layout('layouts.app'))
@section('content')

<style>
/* ── Google Fonts ── */
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

.content-wrapper { font-family: 'Inter', sans-serif; background: #f0f2f5; }

/* ── Top metric cards (line sparkline style) ── */
.metric-card {
    background: #fff;
    border-radius: 14px;
    padding: 20px 22px;
    box-shadow: 0 2px 12px rgba(0,0,0,.06);
    height: 100%;
    position: relative;
    overflow: hidden;
}
.metric-card .metric-label {
    font-size: .78rem;
    font-weight: 600;
    color: #8492a6;
    text-transform: uppercase;
    letter-spacing: .5px;
    margin-bottom: 6px;
}
.metric-card .metric-value {
    font-size: 1.9rem;
    font-weight: 700;
    color: #1a202c;
    line-height: 1.1;
}
.metric-card .metric-sub {
    display: flex;
    align-items: center;
    gap: 6px;
    margin-top: 6px;
    font-size: .78rem;
    color: #8492a6;
}
.metric-card .metric-sub .badge-up   { color: #38a169; font-weight: 600; }
.metric-card .metric-sub .badge-down { color: #e53e3e; font-weight: 600; }
.metric-spark { margin-top: 14px; }

/* ── Donut card ── */
.donut-card {
    background: #fff;
    border-radius: 14px;
    padding: 20px 22px;
    box-shadow: 0 2px 12px rgba(0,0,0,.06);
    height: 100%;
}
.donut-card .metric-label {
    font-size: .78rem;
    font-weight: 600;
    color: #8492a6;
    text-transform: uppercase;
    letter-spacing: .5px;
    margin-bottom: 6px;
}
.donut-legend { margin-top: 12px; }
.donut-legend-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: .82rem;
    margin-bottom: 6px;
    color: #4a5568;
}
.donut-legend-dot {
    width: 10px; height: 10px;
    border-radius: 50%;
    display: inline-block;
    margin-right: 6px;
    flex-shrink: 0;
}

/* ── Stat icon cards (row 2) ── */
.stat-icon-card {
    background: #fff;
    border-radius: 14px;
    padding: 20px 22px;
    box-shadow: 0 2px 12px rgba(0,0,0,.06);
    display: flex;
    align-items: center;
    gap: 16px;
}
.stat-icon-card .icon-wrap {
    width: 54px; height: 54px;
    border-radius: 14px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.4rem;
    flex-shrink: 0;
}
.stat-icon-card .stat-text .label {
    font-size: .78rem;
    font-weight: 600;
    color: #8492a6;
    text-transform: uppercase;
    letter-spacing: .5px;
}
.stat-icon-card .stat-text .value {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1a202c;
    line-height: 1.1;
}

/* ── Chart cards ── */
.chart-card {
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 2px 12px rgba(0,0,0,.06);
    overflow: hidden;
}
.chart-card .chart-header {
    padding: 18px 22px 0;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.chart-card .chart-title {
    font-size: .95rem;
    font-weight: 700;
    color: #1a202c;
}
.chart-card .chart-subtitle {
    font-size: .75rem;
    color: #8492a6;
    margin-top: 2px;
}
.chart-card .chart-body { padding: 10px 22px 18px; }

/* ── Recent borrowers ── */
.recent-card {
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 2px 12px rgba(0,0,0,.06);
    overflow: hidden;
}
.recent-card .recent-header {
    padding: 18px 22px;
    border-bottom: 1px solid #f0f2f5;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.recent-card .recent-title { font-size: .95rem; font-weight: 700; color: #1a202c; }
.recent-list-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 22px;
    border-bottom: 1px solid #f7fafc;
    transition: background .15s;
}
.recent-list-item:hover { background: #f7fafc; }
.recent-list-item:last-child { border-bottom: none; }
.recent-avatar {
    width: 38px; height: 38px;
    border-radius: 50%;
    object-fit: cover;
    flex-shrink: 0;
    background: #e2e8f0;
}
.recent-avatar-placeholder {
    width: 38px; height: 38px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea, #764ba2);
    display: flex; align-items: center; justify-content: center;
    color: #fff; font-weight: 700; font-size: .85rem;
    flex-shrink: 0;
}
.recent-name { font-size: .85rem; font-weight: 600; color: #2d3748; }
.recent-date { font-size: .75rem; color: #a0aec0; }
.recent-status { margin-left: auto; }

/* ── Category bar list ── */
.cat-bar-item { margin-bottom: 12px; }
.cat-bar-label {
    display: flex;
    justify-content: space-between;
    font-size: .8rem;
    margin-bottom: 4px;
    color: #4a5568;
    font-weight: 500;
}
.cat-bar-track {
    height: 7px;
    background: #edf2f7;
    border-radius: 10px;
    overflow: hidden;
}
.cat-bar-fill {
    height: 100%;
    border-radius: 10px;
    transition: width 1s ease;
}

/* ── Section spacing ── */
.dashboard-section { margin-bottom: 24px; }

/* ── Greeting banner ── */
.greeting-banner {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 14px;
    padding: 22px 28px;
    color: #fff;
    margin-bottom: 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.greeting-banner h2 { font-size: 1.3rem; font-weight: 700; margin: 0; }
.greeting-banner p  { margin: 4px 0 0; opacity: .85; font-size: .85rem; }
.greeting-banner .greeting-date {
    background: rgba(255,255,255,.15);
    border-radius: 8px;
    padding: 8px 16px;
    font-size: .82rem;
    text-align: center;
}
.greeting-banner .greeting-date strong { display: block; font-size: 1.4rem; font-weight: 700; }
</style>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{__('admin.dashboard')}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">{{__('admin.home')}}</a></li>
                        <li class="breadcrumb-item active">{{__('admin.dashboard')}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            {{-- ── Greeting Banner ── --}}
            <div class="greeting-banner">
                <div>
                    <h2>👋 Welcome back, {{ Auth::user()->name }}</h2>
                    <p>Here's what's happening in your library today.</p>
                </div>
                <div class="greeting-date d-none d-md-block">
                    <strong id="clockTime">--:--</strong>
                    <span id="clockDate"></span>
                </div>
            </div>

            {{-- ── Row 1: Metric Sparkline Cards ── --}}
            <div class="row dashboard-section">
                {{-- Total Books --}}
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="metric-card">
                        <div class="metric-label">📚 Total Books</div>
                        <div class="metric-value">{{ number_format($books) }}</div>
                        <div class="metric-sub">
                            <span class="badge-up"><i class="fas fa-caret-up"></i> {{ $todayBooks }}</span>
                            added today
                        </div>
                        <div class="metric-spark">
                            <canvas id="sparkBooks" height="50"></canvas>
                        </div>
                    </div>
                </div>

                {{-- Total Borrowers --}}
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="metric-card">
                        <div class="metric-label">📖 Book Borrowers</div>
                        <div class="metric-value">{{ number_format($borrowers) }}</div>
                        <div class="metric-sub">
                            <span class="badge-up"><i class="fas fa-caret-up"></i> {{ $todayBorrowers }}</span>
                            borrowed today
                        </div>
                        <div class="metric-spark">
                            <canvas id="sparkBorrowers" height="50"></canvas>
                        </div>
                    </div>
                </div>

                {{-- Total Attendances --}}
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="metric-card">
                        <div class="metric-label">🗓️ Attendances</div>
                        <div class="metric-value">{{ number_format($attendances) }}</div>
                        <div class="metric-sub">
                            <span class="badge-up"><i class="fas fa-caret-up"></i> {{ $todayAttendances }}</span>
                            checked in today
                        </div>
                        <div class="metric-spark">
                            <canvas id="sparkAttendances" height="50"></canvas>
                        </div>
                    </div>
                </div>

                {{-- Borrower Status Donut --}}
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="donut-card">
                        <div class="metric-label">📊 Borrow Status</div>
                        <div style="position:relative; height:110px;">
                            <canvas id="donutBorrow"></canvas>
                        </div>
                        <div class="donut-legend">
                            <div class="donut-legend-item">
                                <span><span class="donut-legend-dot" style="background:#4f86f7"></span>Borrowed</span>
                                <strong>{{ $borrowedCount }}</strong>
                            </div>
                            <div class="donut-legend-item">
                                <span><span class="donut-legend-dot" style="background:#38a169"></span>Repayed</span>
                                <strong>{{ $repayedCount }}</strong>
                            </div>
                            <div class="donut-legend-item">
                                <span><span class="donut-legend-dot" style="background:#f6ad55"></span>Pending</span>
                                <strong>{{ $pendingCount }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── Row 2: Stat Icon Cards ── --}}
            <div class="row dashboard-section">
                <div class="col-lg-3 col-sm-6 mb-4">
                    <div class="stat-icon-card">
                        <div class="icon-wrap" style="background:#ebf4ff;">
                            <i class="fas fa-users" style="color:#4f86f7"></i>
                        </div>
                        <div class="stat-text">
                            <div class="label">Total Students</div>
                            <div class="value">{{ number_format($students) }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mb-4">
                    <div class="stat-icon-card">
                        <div class="icon-wrap" style="background:#fef3c7;">
                            <i class="fas fa-user-tie" style="color:#d97706"></i>
                        </div>
                        <div class="stat-text">
                            <div class="label">Staff Users</div>
                            <div class="value">{{ number_format($users) }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mb-4">
                    <div class="stat-icon-card">
                        <div class="icon-wrap" style="background:#f0fff4;">
                            <i class="fas fa-check-double" style="color:#38a169"></i>
                        </div>
                        <div class="stat-text">
                            <div class="label">Books Returned</div>
                            <div class="value">{{ number_format($repayedCount) }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mb-4">
                    <div class="stat-icon-card">
                        <div class="icon-wrap" style="background:#fff5f5;">
                            <i class="fas fa-hourglass-half" style="color:#e53e3e"></i>
                        </div>
                        <div class="stat-text">
                            <div class="label">Still Borrowed</div>
                            <div class="value">{{ number_format($borrowedCount) }}</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── Row 3: Main Charts ── --}}
            <div class="row dashboard-section">

                {{-- Monthly Overview Chart --}}
                <div class="col-lg-8 mb-4">
                    <div class="chart-card">
                        <div class="chart-header">
                            <div>
                                <div class="chart-title">Monthly Overview</div>
                                <div class="chart-subtitle">Borrowers & Attendances — last 6 months</div>
                            </div>
                            <div>
                                <span class="badge badge-pill" style="background:#ebf4ff;color:#4f86f7;font-size:.75rem;padding:5px 10px;">
                                    <i class="fas fa-circle mr-1" style="font-size:.5rem"></i>Borrowers
                                </span>
                                <span class="badge badge-pill ml-1" style="background:#f0fff4;color:#38a169;font-size:.75rem;padding:5px 10px;">
                                    <i class="fas fa-circle mr-1" style="font-size:.5rem"></i>Attendance
                                </span>
                            </div>
                        </div>
                        <div class="chart-body">
                            <canvas id="lineChart" height="100"></canvas>
                        </div>
                    </div>
                </div>

                {{-- Top Categories --}}
                <div class="col-lg-4 mb-4">
                    <div class="chart-card" style="height:100%">
                        <div class="chart-header">
                            <div>
                                <div class="chart-title">Top Categories</div>
                                <div class="chart-subtitle">Books by category</div>
                            </div>
                        </div>
                        <div class="chart-body">
                            @php
                                $maxCat = $topCategories->max('total') ?: 1;
                                $barColors = ['#4f86f7','#38a169','#f6ad55','#e53e3e','#9f7aea'];
                            @endphp
                            @foreach($topCategories as $i => $cat)
                            <div class="cat-bar-item">
                                <div class="cat-bar-label">
                                    <span>{{ $cat->name }}</span>
                                    <span style="color:{{ $barColors[$i % 5] }};font-weight:700">{{ $cat->total }}</span>
                                </div>
                                <div class="cat-bar-track">
                                    <div class="cat-bar-fill" style="width:{{ round($cat->total / $maxCat * 100) }}%; background:{{ $barColors[$i % 5] }}"></div>
                                </div>
                            </div>
                            @endforeach
                            @if($topCategories->isEmpty())
                                <p class="text-muted text-center py-3" style="font-size:.85rem">No category data yet.</p>
                            @endif
                        </div>
                    </div>
                </div>

            </div>

            {{-- ── Row 4: New Books Chart + Recent Borrowers ── --}}
            <div class="row dashboard-section">

                {{-- New Books per Month ── bar chart --}}
                <div class="col-lg-5 mb-4">
                    <div class="chart-card">
                        <div class="chart-header">
                            <div>
                                <div class="chart-title">New Books Added</div>
                                <div class="chart-subtitle">Monthly — last 6 months</div>
                            </div>
                        </div>
                        <div class="chart-body">
                            <canvas id="barBooks" height="140"></canvas>
                        </div>
                    </div>
                </div>

                {{-- Recent Borrowers --}}
                <div class="col-lg-7 mb-4">
                    <div class="recent-card">
                        <div class="recent-header">
                            <span class="recent-title">Recent Borrowers</span>
                            <a href="{{ admin_url('borrowers') }}" class="btn btn-sm btn-light border" style="font-size:.78rem">
                                View All <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                        @forelse($recentBorrowers as $borrow)
                        <div class="recent-list-item">
                            @if($borrow->student_image)
                                <img src="{{ asset('uploads/student/'.$borrow->student_image) }}"
                                     class="recent-avatar"
                                     onerror="this.onerror=null;this.style.display='none';this.nextElementSibling.style.display='flex';">
                                <div class="recent-avatar-placeholder" style="display:none">
                                    {{ strtoupper(substr($borrow->first_name,0,1)) }}
                                </div>
                            @else
                                <div class="recent-avatar-placeholder">
                                    {{ strtoupper(substr($borrow->first_name ?? 'U', 0, 1)) }}
                                </div>
                            @endif
                            <div>
                                <div class="recent-name">{{ $borrow->first_name }} {{ $borrow->last_name }}</div>
                                <div class="recent-date">{{ \Carbon\Carbon::parse($borrow->created_at)->diffForHumans() }}</div>
                            </div>
                            <div class="recent-status">
                                @if($borrow->status === 'borrowed')
                                    <span class="badge badge-pill" style="background:#ebf4ff;color:#4f86f7;font-size:.75rem">Borrowed</span>
                                @elseif($borrow->status === 'repayed')
                                    <span class="badge badge-pill" style="background:#f0fff4;color:#38a169;font-size:.75rem">Returned</span>
                                @else
                                    <span class="badge badge-pill" style="background:#fef3c7;color:#d97706;font-size:.75rem">Pending</span>
                                @endif
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-4 text-muted" style="font-size:.85rem">
                            <i class="fas fa-inbox fa-2x mb-2 d-block" style="color:#cbd5e0"></i>
                            No borrowers yet.
                        </div>
                        @endforelse
                    </div>
                </div>

            </div>

        </div>
    </section>
</div>

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script>
$(function () {

    // ── Clock ──
    function updateClock() {
        var now  = new Date();
        var h    = String(now.getHours()).padStart(2,'0');
        var m    = String(now.getMinutes()).padStart(2,'0');
        var s    = String(now.getSeconds()).padStart(2,'0');
        var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
        var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
        document.getElementById('clockTime').textContent = h + ':' + m + ':' + s;
        document.getElementById('clockDate').textContent =
            days[now.getDay()] + ', ' + months[now.getMonth()] + ' ' + now.getDate();
    }
    updateClock();
    setInterval(updateClock, 1000);

    // ── Data from PHP ──
    var labels       = {!! $monthlyLabels !!};
    var borrowerData = {!! $monthlyBorrowers !!};
    var attendData   = {!! $monthlyAttendances !!};
    var bookData     = {!! $monthlyBooks !!};

    // ── Sparkline factory ──
    function sparkline(id, data, color) {
        var ctx = document.getElementById(id);
        if (!ctx) return;
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    borderColor: color,
                    borderWidth: 2,
                    pointRadius: 0,
                    fill: true,
                    backgroundColor: hexToRgba(color, 0.12),
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false }, tooltip: { enabled: false } },
                scales:  { x: { display: false }, y: { display: false } }
            }
        });
    }

    function hexToRgba(hex, alpha) {
        var r = parseInt(hex.slice(1,3),16),
            g = parseInt(hex.slice(3,5),16),
            b = parseInt(hex.slice(5,7),16);
        return 'rgba('+r+','+g+','+b+','+alpha+')';
    }

    sparkline('sparkBooks',       bookData,     '#4f86f7');
    sparkline('sparkBorrowers',   borrowerData, '#9f7aea');
    sparkline('sparkAttendances', attendData,   '#38a169');

    // ── Donut ──
    new Chart(document.getElementById('donutBorrow'), {
        type: 'doughnut',
        data: {
            labels: ['Borrowed', 'Repayed', 'Pending'],
            datasets: [{
                data: [{{ $borrowedCount }}, {{ $repayedCount }}, {{ $pendingCount }}],
                backgroundColor: ['#4f86f7','#38a169','#f6ad55'],
                borderWidth: 0,
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%',
            plugins: {
                legend: { display: false },
                tooltip: { callbacks: {
                    label: function(ctx) { return ' ' + ctx.label + ': ' + ctx.raw; }
                }}
            }
        }
    });

    // ── Main Line Chart ──
    new Chart(document.getElementById('lineChart'), {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Borrowers',
                    data: borrowerData,
                    borderColor: '#4f86f7',
                    backgroundColor: 'rgba(79,134,247,0.08)',
                    borderWidth: 2.5,
                    pointRadius: 4,
                    pointBackgroundColor: '#4f86f7',
                    fill: true,
                    tension: 0.4
                },
                {
                    label: 'Attendance',
                    data: attendData,
                    borderColor: '#38a169',
                    backgroundColor: 'rgba(56,161,105,0.08)',
                    borderWidth: 2.5,
                    pointRadius: 4,
                    pointBackgroundColor: '#38a169',
                    fill: true,
                    tension: 0.4
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: { display: false },
                tooltip: { mode: 'index', intersect: false }
            },
            scales: {
                x: { grid: { display: false }, ticks: { font: { size: 11 } } },
                y: { grid: { color: '#f0f2f5' }, ticks: { font: { size: 11 }, stepSize: 1 }, beginAtZero: true }
            }
        }
    });

    // ── Bar Chart (New Books) ──
    new Chart(document.getElementById('barBooks'), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'New Books',
                data: bookData,
                backgroundColor: [
                    'rgba(79,134,247,0.8)',
                    'rgba(159,122,234,0.8)',
                    'rgba(56,161,105,0.8)',
                    'rgba(246,173,85,0.8)',
                    'rgba(229,62,62,0.8)',
                    'rgba(79,134,247,0.8)',
                ],
                borderRadius: 8,
                borderSkipped: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: { legend: { display: false } },
            scales: {
                x: { grid: { display: false }, ticks: { font: { size: 11 } } },
                y: { grid: { color: '#f0f2f5' }, beginAtZero: true, ticks: { font: { size: 11 }, stepSize: 1 } }
            }
        }
    });

});
</script>
@endsection

@stop