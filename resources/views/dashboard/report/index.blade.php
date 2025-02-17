@extends('dashboard.dashboard')

@section('content')
<div class="container my-5">
    <div class="row g-4">
        <!-- First row -->
        <div class="col-lg-4 col-md-6">
            <div class="card h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <p class="card-text">Admin</p>
                    <span class="badge bg-light text-dark">{{ $adminCount }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <p class="card-text">Pre Approved adviser firm</p>
                    <span class="badge bg-light text-dark">{{ $employeeCount }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <p class="card-text">Adviser Firm</p>
                    <span class="badge bg-light text-dark">{{ $advisorFirmAdminCount }}</span>
                </div>
            </div>
        </div>

        <!-- Second row -->
        <div class="col-lg-4 col-md-6">
            <div class="card h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <p class="card-text">Adviser</p>
                    <span class="badge bg-light text-dark">{{ $advisorCount }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <p class="card-text">Total Oasis SIPP</p>
                    <span class="badge bg-light text-dark">{{ $createOasisSippCount }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <p class="card-text">Total SIPP Property</p>
                    <span class="badge bg-light text-dark">{{ $createSippPropertyCount }}</span>
                </div>
            </div>
        </div>

        <!-- Third row -->
        <div class="col-lg-6 col-md-6">
            <div class="card h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <p class="card-text">Total Full SIPP Property</p>
                    <span class="badge bg-light text-dark">{{ $createFullSippPropertyCount }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="card h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <p class="card-text">Total FPT</p>
                    <span class="badge bg-light text-dark">{{ $createFptCount }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Doughnut Chart -->
    <div class="row mt-5">
        <div class="col-lg-6 offset-lg-3">
            <canvas id="roleChart"></canvas>
        </div>
    </div>
</div>
@endsection

@section('style')
    <style>
        body {
            background-color: #121212;
            color: #ffffff; /* Text color */
        }
        .card {
            background-color: #2D324A; /* Card background color */
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .card:hover {
            background-color: #3A3F57;
        }
        .card-text {
            font-size: 1.1rem;
            padding: 20px 0;
            color: #ffffff; /* Ensure text remains white */
        }
        .badge {
            font-size: 1rem;
            padding: 10px 15px;
        }
        canvas {
            max-width: 300px; /* Reduce the size of the doughnut chart */
            margin: 0 auto;
        }
    </style>
@endsection

@section('script')
    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Role data
        const roleCounts = {
            admin: {{ $adminCount }},
            employee: {{ $employeeCount }},
            advisorFirmAdmin: {{ $advisorFirmAdminCount }},
            advisor: {{ $advisorCount }},
            oasisSipp: {{ $createOasisSippCount }},
            sippProperty: {{ $createSippPropertyCount }},
            fullSippProperty: {{ $createFullSippPropertyCount }},
            fpt: {{ $createFptCount }}
        };

        // Filter roles that have zero count
        const roleLabels = [
            'Admin', 'Pre Approved Adviser Firm', 'Advisor Firm Admin', 'Advisor',
            'Oasis SIPP', 'SIPP Property', 'Full SIPP Property', 'FPT'
        ];

        const roleValues = [
            roleCounts.admin,
            roleCounts.employee,
            roleCounts.advisorFirmAdmin,
            roleCounts.advisor,
            roleCounts.oasisSipp,
            roleCounts.sippProperty,
            roleCounts.fullSippProperty,
            roleCounts.fpt
        ];

        const backgroundColors = [
            '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0',
            '#9966FF', '#FF9F40', '#FFCD56', '#4BC0C0'
        ];

        // Only include roles with non-zero values
        const filteredLabels = roleLabels.filter((label, index) => roleValues[index] > 0);
        const filteredData = roleValues.filter(value => value > 0);
        const filteredColors = backgroundColors.filter((color, index) => roleValues[index] > 0);

        // Create doughnut chart
        const ctx = document.getElementById('roleChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: filteredLabels,
                datasets: [{
                    data: filteredData,
                    backgroundColor: filteredColors,
                    hoverBackgroundColor: filteredColors
                }]
            },
            options: {
                responsive: true,
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'User Roles Distribution'
                }
            }
        });
    </script>
@endsection
