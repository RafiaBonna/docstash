@extends('master')

@section('content')

    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>128</h3>
                    <p>TODAY'S ORDERS</p>
                </div>
                <div class="icon">
                    <i class="ion fas fa-shopping-cart"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>$7,800</h3>
                    <p>MONTHLY REVENUE</p>
                </div>
                <div class="icon">
                    <i class="ion fas fa-dollar-sign"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>8</h3>
                    <p>NEW SUPPORT TICKETS</p>
                </div>
                <div class="icon">
                    <i class="ion fas fa-life-ring"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>5,420</h3>
                    <p>TOTAL USERS</p>
                </div>
                <div class="icon">
                    <i class="ion fas fa-users"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
    <div class="row">
        
        <section class="col-lg-7 connectedSortable">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Monthly Sales ($) (Demo Data)</h3>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="salesChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </section>

        <section class="col-lg-5 connectedSortable">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Top Categories Distribution (Demo Data)</h3>
                </div>
                <div class="card-body">
                    <canvas id="categoryChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
        </section>
    </div>
    <div class="row">
        <div class="col-12">
            </div>
    </div>

@endsection

@push('scripts') 
{{-- Chart.js CDN লোড করতে হবে (AdminLTE স্ক্রিপ্ট লোড হওয়ার পরে) --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script> 

<script>
    // Hardcoded Static Data for Charts
    const salesData = {
        labels: ['Mar', 'Apr', 'May', 'Jun', 'Jul'],
        data: [4800, 6000, 7500, 6800, 8200]
    };

    const categoryData = {
        labels: ['Electronics', 'Apparel', 'Books', 'Home Goods'],
        data: [30, 20, 15, 35]
    };

    // 1. Monthly Sales Chart
    const salesCtx = document.getElementById('salesChart');
    if(salesCtx) {
        new Chart(salesCtx, {
            type: 'line',
            data: {
                labels: salesData.labels,
                datasets: [{
                    label: "Monthly Sales ($)",
                    // AdminLTE's preferred line options for Area Chart style
                    backgroundColor: 'rgba(60,141,188,0.9)', 
                    borderColor: 'rgba(60,141,188,0.8)',
                    data: salesData.data,
                    fill: false, // Set to true for area chart fill
                    tension: 0.3
                }],
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
            }
        });
    }

    // 2. Category Pie Chart
    const categoryCtx = document.getElementById('categoryChart');
    if(categoryCtx) {
        new Chart(categoryCtx, {
            type: 'doughnut',
            data: {
                labels: categoryData.labels,
                datasets: [{
                    data: categoryData.data,
                    backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef'], 
                }],
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
            },
        });
    }

</script>
@endpush