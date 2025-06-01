@extends('admin.includes.master')

@section('admin.content')
<style>
  .stat-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border-radius: 15px;
    overflow: hidden;
    border: none;
  }
  
  .stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.12), 0 4px 8px rgba(0,0,0,0.06) !important;
  }
  
  .counter {
    width: 80px;
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s;
  }
  
  .stat-card:hover .counter {
    transform: scale(1.1);
  }
  
  .chart-card {
    border-radius: 15px;
    border: none;
  }
  
  .status-circle {
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: transform 0.3s;
  }
  
  .status-circle:hover {
    transform: scale(1.1);
  }
  
  .card-header {
    background: linear-gradient(to right, #f8f9fa, #ffffff);
    border-bottom: none;
  }

  @media (max-width: 767.98px) {
    .status-circle {
      width: 50px;
      height: 50px;
    }
    
    .card-header h5 {
      font-size: 1rem;
    }
    
    #hotCount, #coldCount, #pendingCount {
      font-size: 1.25rem;
    }
    
    .container-fluid {
      padding-left: 10px;
      padding-right: 10px;
    }
    
    .card {
      margin-bottom: 15px;
    }
    
    .conversion-details h5 {
      font-size: 0.9rem;
    }
  }
</style>

<main class="main">
  <title>Fitness Gym | {{$title}}</title>
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h5 class="m-0 text-dark">Dashboard</h5>
        </div>
        <div class="col-sm-6">
          <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb mb-0 mr-3">
              <li class="breadcrumb-item">
                <a class="text-secondary" href="{{ route('admin.dashboard') }}">home</a>
              </li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <!-- QR Code button properly positioned -->
            <a href="{{ route('public.inquiry.qr') }}" class="btn btn-info">
              <i class="fas fa-qrcode mr-1"></i> QR Code
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid mt-4">
    <div class="row">
      <!-- Total Members Card -->
      <div class="col-lg-4 col-md-6 mb-4">
        <a href="{{ route('member') }}" class="text-decoration-none">
          <div class="card stat-card shadow">
            <div class="card-body text-center p-4">
              <div class="counter bg-primary text-white rounded-circle mb-3 mx-auto">
                <i class="fas fa-users fa-2x"></i>
              </div>
              <h3 class="mt-3 font-weight-bold text-dark">{{ $totalMembers }}</h3>
              <p class="text-muted mb-0">Total Members</p>
              
              <!-- Time-based member statistics -->
              <div class="row mt-3 mb-3">
                <div class="col-6 col-xl-3 border-right">
                  <h5 class="font-weight-bold text-primary mb-0">{{ $todayMembers }}</h5>
                  <small class="text-muted">Today</small>
                </div>
                <div class="col-6 col-xl-3 border-right">
                  <h5 class="font-weight-bold text-primary mb-0">{{ $thisMonthMembers }}</h5>
                  <small class="text-muted">This Month</small>
                </div>
                <div class="col-6 col-xl-3 border-right">
                  <h5 class="font-weight-bold text-primary mb-0">{{ $lastMonthMembers }}</h5>
                  <small class="text-muted">Last Month</small>
                </div>
                <div class="col-6 col-xl-3">
                  <h5 class="font-weight-bold text-primary mb-0">{{ $thisYearMembers }}</h5>
                  <small class="text-muted">This Year</small>
                </div>
              </div>
            </div>
            <div class="card-footer bg-light border-0 text-center">
              <span class="text-primary">View Details <i class="fas fa-arrow-right ml-1"></i></span>
            </div>
          </div>
        </a>
      </div>

      <!-- Upcoming Renewables Card -->
      <div class="col-lg-4 col-md-6 mb-4">
        <a href="{{ route('reneable') }}" class="text-decoration-none">
          <div class="card stat-card shadow">
            <div class="card-body text-center p-4">
              <div class="counter bg-success text-white rounded-circle mb-3 mx-auto">
                <i class="fas fa-undo-alt fa-2x"></i>
              </div>
              <h3 class="mt-3 font-weight-bold text-dark">{{ $upcomingReneableCount }}</h3>
              <p class="text-muted mb-0">Upcoming Renewals</p>
              
              <!-- Time-based renewal statistics -->
              <div class="row mt-3 mb-3">
                <div class="col-6 col-xl-3 border-right">
                  <h5 class="font-weight-bold text-success mb-0">{{ $todayRenewals }}</h5>
                  <small class="text-muted">Today</small>
                </div>
                <div class="col-6 col-xl-3 border-right">
                  <h5 class="font-weight-bold text-success mb-0">{{ $thisMonthRenewals }}</h5>
                  <small class="text-muted">This Month</small>
                </div>
                <div class="col-6 col-xl-3 border-right">
                  <h5 class="font-weight-bold text-success mb-0">{{ $lastMonthRenewals }}</h5>
                  <small class="text-muted">Last Month</small>
                </div>
                <div class="col-6 col-xl-3">
                  <h5 class="font-weight-bold text-success mb-0">{{ $thisYearRenewals }}</h5>
                  <small class="text-muted">This Year</small>
                </div>
              </div>
            </div>
            <div class="card-footer bg-light border-0 text-center">
              <span class="text-success">View Details <i class="fas fa-arrow-right ml-1"></i></span>
            </div>
          </div>
        </a>
      </div>
      
      <!-- Total Inquiries Card - Enhanced with time period statistics -->
      <div class="col-lg-4 col-md-6 mb-4">
        <a href="{{ route('inquiries') }}" class="text-decoration-none">
          <div class="card stat-card shadow">
            <div class="card-body text-center p-4">
              <div class="counter bg-info text-white rounded-circle mb-3 mx-auto">
                <i class="fas fa-question-circle fa-2x"></i>
              </div>
                   <h3 class="mt-3 font-weight-bold text-dark">{{ $hotInquiries + $coldInquiries + $pendingInquiries }}</h3>
              <p class="text-muted mb-0">Total Inquiries</p>
              
              <!-- Time-based inquiry statistics -->
              <div class="row mt-3 mb-3">
                <div class="col-6 col-xl-3 border-right">
                  <h5 class="font-weight-bold text-info mb-0">{{ $todayInquiries }}</h5>
                  <small class="text-muted">Today</small>
                </div>
                <div class="col-6 col-xl-3 border-right">
                  <h5 class="font-weight-bold text-info mb-0">{{ $thisMonthInquiries }}</h5>
                  <small class="text-muted">This Month</small>
                </div>
                <div class="col-6 col-xl-3 border-right">
                  <h5 class="font-weight-bold text-info mb-0">{{ $lastMonthInquiries }}</h5>
                  <small class="text-muted">Last Month</small>
                </div>
                <div class="col-6 col-xl-3">
                  <h5 class="font-weight-bold text-info mb-0">{{ $thisYearInquiries }}</h5>
                  <small class="text-muted">This Year</small>
                </div>
              </div>
            </div>
            <div class="card-footer bg-light border-0 text-center">
              <span class="text-info">View Details <i class="fas fa-arrow-right ml-1"></i></span>
            </div>
          </div>
        </a>
      </div>
    </div>

    <!-- Merged Chart Sections - All 3 boxes in one row -->
    <div class="row mt-4">
      <!-- Status Details Card -->
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="card chart-card shadow h-100">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-info-circle mr-2"></i>Status Details</h5>
            <span class="badge badge-pill badge-light" id="period-label">Today</span>
          </div>
          <div class="card-body">
            <div class="row mb-4 justify-content-center">
              <div class="col-4">
                <div class="status-circle rounded-circle mx-auto mb-2" style="background: linear-gradient(135deg, #ff6b6b, #dc3545);">
                  <h3 class="text-white m-0" id="hotCount">{{ $hotInquiries }}</h3>
                </div>
                <p class="font-weight-bold text-center mb-0">Hot</p>
              </div>
              <div class="col-4">
                <div class="status-circle rounded-circle mx-auto mb-2" style="background: linear-gradient(135deg, #52b788, #28a745);">
                  <h3 class="text-white m-0" id="coldCount">{{ $coldInquiries }}</h3>
                </div>
                <p class="font-weight-bold text-center mb-0">Cold</p>
              </div>
              <div class="col-4">
                <div class="status-circle rounded-circle mx-auto mb-2" style="background: linear-gradient(135deg, #adb5bd, #6c757d);">
                  <h3 class="text-white m-0" id="pendingCount">{{ $pendingInquiries }}</h3>
                </div>
                <p class="font-weight-bold text-center mb-0">Pending</p>
              </div>
            </div>
            
            <div class="mt-2">
              <div class="card bg-light">
                <div class="card-body py-3">
                  <div class="row align-items-center">
                    <div class="col">
                      <h5 class="mb-0">Conversion Rate</h5>
                      <small class="text-muted">Hot inquiries percentage</small>
                    </div>
                    <div class="col-auto">
                      <h4 id="conversionRate" class="mb-0 badge badge-pill {{ ($hotInquiries + $coldInquiries + $pendingInquiries) > 0 && ($hotInquiries / ($hotInquiries + $coldInquiries + $pendingInquiries) * 100) > 50 ? 'badge-success' : 'badge-warning' }} px-3 py-2">
                        {{ ($hotInquiries + $coldInquiries + $pendingInquiries) > 0 
                            ? number_format(($hotInquiries / ($hotInquiries + $coldInquiries + $pendingInquiries) * 100), 1)
                            : 0 }}%
                      </h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Inquiry Status Pie Chart Card -->
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="card chart-card shadow h-100">
          <div class="card-header">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
              <h5 class="mb-2 mb-md-0"><i class="fas fa-chart-pie mr-2"></i>Inquiry Status</h5>
              
              <!-- Time filter buttons for larger screens -->
              <div class="btn-group time-filter d-none d-md-inline-flex">
                <button type="button" class="btn btn-sm btn-primary active" data-period="today">Today</button>
                <button type="button" class="btn btn-sm btn-outline-primary" data-period="month">This Month</button>
                <button type="button" class="btn btn-sm btn-outline-primary" data-period="year">Year</button>
              </div>
              
              <!-- Dropdown for mobile view -->
              <div class="dropdown d-md-none w-100 mt-2">
                <button class="btn btn-outline-primary btn-sm dropdown-toggle w-100" type="button" id="timeFilterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span id="selected-period">Today</span>
                </button>
                <div class="dropdown-menu dropdown-menu-right w-100" aria-labelledby="timeFilterDropdown">
                  <button class="dropdown-item active" type="button" data-period="today">Today</button>
                  <button class="dropdown-item" type="button" data-period="month">This Month</button>
                  <button class="dropdown-item" type="button" data-period="prev_month">Previous Month</button>
                  <button class="dropdown-item" type="button" data-period="year">This Year</button>
                  <button class="dropdown-item" type="button" data-period="all">All Time</button>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div id="chart-container" class="position-relative" style="height: 220px;">
              <canvas id="inquiryPieChart"></canvas>
            </div>
            <div id="loading-spinner" class="text-center py-5 d-none">
              <div class="spinner-border text-primary" role="status">
                <span class="sr-only">Loading...</span>
              </div>
              <p class="mt-2">Loading data...</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Inquiry Trends Line Chart Card -->
      <div class="col-lg-4 col-md-12 mb-4">
        <div class="card chart-card shadow h-100">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-chart-line mr-2"></i>Inquiry Trends</h5>
            <div class="btn-group trend-filter">
              <button type="button" class="btn btn-sm btn-primary active" data-trend="month">Monthly</button>
              <button type="button" class="btn btn-sm btn-outline-primary" data-trend="year">Yearly</button>
            </div>
          </div>
          <div class="card-body">
            <div id="trend-container" class="position-relative" style="height: 220px;">
              <canvas id="inquiryTrendChart"></canvas>
            </div>
            <div id="trend-loading-spinner" class="text-center py-5 d-none">
              <div class="spinner-border text-primary" role="status">
                <span class="sr-only">Loading...</span>
              </div>
              <p class="mt-2">Loading trend data...</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  let inquiryChart;
  let trendChart;

  document.addEventListener('DOMContentLoaded', function() {
    // Get the canvas element
    const ctx = document.getElementById('inquiryPieChart').getContext('2d');
    
    // Initial chart data
    const initialData = {
      labels: ['Hot', 'Cold', 'Pending'],
      datasets: [{
        data: [{{ $hotInquiries }}, {{ $coldInquiries }}, {{ $pendingInquiries }}],
        backgroundColor: [
          'rgba(220, 53, 69, 0.8)',  // Red for Hot
          'rgba(40, 167, 69, 0.8)',   // Green for Cold
          'rgba(108, 117, 125, 0.8)'  // Gray for Pending
        ],
        borderColor: [
          '#dc3545',
          '#28a745',
          '#6c757d'
        ],
        borderWidth: 2,
        hoverOffset: 15,
        hoverBorderWidth: 3
      }]
    };
    
    // Chart configuration
    const config = {
      type: 'doughnut',
      data: initialData,
      options: {
        responsive: true,
        maintainAspectRatio: false,
        cutout: '65%',
        plugins: {
          legend: {
            position: 'right',
            labels: {
              padding: 20,
              font: {
                size: 14,
                weight: 'bold'
              },
              usePointStyle: true,
              pointStyle: 'circle'
            }
          },
          tooltip: {
            backgroundColor: 'rgba(0,0,0,0.8)',
            titleFont: {
              size: 16,
              weight: 'bold'
            },
            bodyFont: {
              size: 14
            },
            padding: 12,
            cornerRadius: 8,
            callbacks: {
              label: function(context) {
                const label = context.label || '';
                const value = context.raw || 0;
                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                const percentage = total > 0 ? Math.round((value / total) * 100) : 0;
                return `${label}: ${value} (${percentage}%)`;
              }
            }
          }
        },
        animation: {
          animateScale: true,
          animateRotate: true
        }
      }
    };
    
    // Initialize the chart
    inquiryChart = new Chart(ctx, config);
    
    // Set up the time filter buttons
    const timeFilterButtons = document.querySelectorAll('.time-filter button');
    timeFilterButtons.forEach(button => {
      button.addEventListener('click', function() {
        // Remove active class from all buttons
        timeFilterButtons.forEach(btn => btn.classList.remove('active', 'btn-primary'));
        timeFilterButtons.forEach(btn => btn.classList.add('btn-outline-primary'));
        
        // Add active class to clicked button
        this.classList.remove('btn-outline-primary');
        this.classList.add('active', 'btn-primary');
        
        // Update period label
        const periodLabel = document.getElementById('period-label');
        periodLabel.textContent = this.textContent;
        
        // Update data based on selected period
        updateChartData(this.getAttribute('data-period'));
      });
    });
    
    // Set up the time filter dropdown for mobile
    const dropdownItems = document.querySelectorAll('.dropdown-menu .dropdown-item');
    dropdownItems.forEach(item => {
      item.addEventListener('click', function() {
        // Remove active class from all items
        dropdownItems.forEach(i => i.classList.remove('active'));
        
        // Add active class to clicked item
        this.classList.add('active');
        
        // Update the dropdown button text
        document.getElementById('selected-period').textContent = this.textContent;
        
        // Update period label
        updatePeriodLabel(this.textContent);
        
        // Update data based on selected period
        updateChartData(this.getAttribute('data-period'));
      });
    });
    
    // Function to update the period label in both places
    function updatePeriodLabel(text) {
      document.getElementById('period-label').textContent = text;
    }
    
    // Initial load with 'today' filter
    updateChartData('today');
    
    // Initialize the trend chart (line chart)
    initTrendChart();
    
    // Set up trend filter buttons
    const trendFilterButtons = document.querySelectorAll('.trend-filter button');
    trendFilterButtons.forEach(button => {
      button.addEventListener('click', function() {
        // Remove active class from all buttons
        trendFilterButtons.forEach(btn => btn.classList.remove('active', 'btn-primary'));
        trendFilterButtons.forEach(btn => btn.classList.add('btn-outline-primary'));
        
        // Add active class to clicked button
        this.classList.remove('btn-outline-primary');
        this.classList.add('active', 'btn-primary');
        
        // Update trend data based on selected period
        updateTrendData(this.getAttribute('data-trend'));
      });
    });
    
    // Initial load of monthly trend data
    updateTrendData('month');
  });

  // Function to initialize trend chart
  function initTrendChart() {
    const ctx = document.getElementById('inquiryTrendChart').getContext('2d');
    
    trendChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: [],
        datasets: [
          {
            label: 'Hot Inquiries',
            data: [],
            borderColor: 'rgba(220, 53, 69, 1)',
            backgroundColor: 'rgba(220, 53, 69, 0.1)',
            borderWidth: 2,
            tension: 0.4,
            fill: true
          },
          {
            label: 'Cold Inquiries',
            data: [],
            borderColor: 'rgba(40, 167, 69, 1)',
            backgroundColor: 'rgba(40, 167, 69, 0.1)',
            borderWidth: 2,
            tension: 0.4,
            fill: true
          },
          {
            label: 'Pending Inquiries',
            data: [],
            borderColor: 'rgba(108, 117, 125, 1)',
            backgroundColor: 'rgba(108, 117, 125, 0.1)',
            borderWidth: 2,
            tension: 0.4,
            fill: true
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        interaction: {
          mode: 'index',
          intersect: false,
        },
        plugins: {
          legend: {
            position: 'top',
            labels: {
              usePointStyle: true,
              boxWidth: 10
            }
          },
          tooltip: {
            backgroundColor: 'rgba(0,0,0,0.8)',
            padding: 12,
            titleColor: '#ffffff',
            bodyColor: '#ffffff',
            bodySpacing: 8,
            cornerRadius: 8,
          }
        },
        scales: {
          x: {
            grid: {
              display: false
            }
          },
          y: {
            beginAtZero: true,
            grid: {
              color: 'rgba(0, 0, 0, 0.05)'
            },
            ticks: {
              precision: 0
            }
          }
        }
      }
    });
  }

  // Function to update chart and stats with filtered data
  function updateChartData(period) {
    const chartContainer = document.getElementById('chart-container');
    const loadingSpinner = document.getElementById('loading-spinner');
    
    // Show loading indicator
    chartContainer.classList.add('d-none');
    loadingSpinner.classList.remove('d-none');
    
    // Fetch filtered data from API
    fetch(`/api/inquiries-stats?period=${period}`)
      .then(response => response.json())
      .then(data => {
        // Update chart
        inquiryChart.data.datasets[0].data = [data.hot, data.cold, data.pending];
        inquiryChart.update();
        
        // Update status counts
        document.getElementById('hotCount').textContent = data.hot;
        document.getElementById('coldCount').textContent = data.cold;
        document.getElementById('pendingCount').textContent = data.pending;
        
        // Update conversion rate
        const conversionRate = document.getElementById('conversionRate');
        conversionRate.textContent = `${data.conversionRate}%`;
        
        // Update conversion rate badge color
        if (parseFloat(data.conversionRate) > 50) {
          conversionRate.classList.remove('badge-warning');
          conversionRate.classList.add('badge-success');
        } else {
          conversionRate.classList.remove('badge-success');
          conversionRate.classList.add('badge-warning');
        }
        
        // Hide loading spinner and show chart
        loadingSpinner.classList.add('d-none');
        chartContainer.classList.remove('d-none');
      })
      .catch(error => {
        console.error('Error fetching data:', error);
        loadingSpinner.classList.add('d-none');
        chartContainer.classList.remove('d-none');
      });
  }

  // Function to update trend data
  function updateTrendData(period) {
    const trendContainer = document.getElementById('trend-container');
    const loadingSpinner = document.getElementById('trend-loading-spinner');
    
    // Show loading indicator
    trendContainer.classList.add('d-none');
    loadingSpinner.classList.remove('d-none');
    
    // Fetch trend data from API
    fetch(`/api/inquiries-trends?period=${period}`)
      .then(response => response.json())
      .then(data => {
        // Update chart labels and datasets
        trendChart.data.labels = data.labels;
        trendChart.data.datasets[0].data = data.hot;
        trendChart.data.datasets[1].data = data.cold;
        trendChart.data.datasets[2].data = data.pending;
        trendChart.update();
        
        // Hide loading spinner and show chart
        loadingSpinner.classList.add('d-none');
        trendContainer.classList.remove('d-none');
      })
      .catch(error => {
        console.error('Error fetching trend data:', error);
        loadingSpinner.classList.add('d-none');
        trendContainer.classList.remove('d-none');
      });
  }
</script>
@endsection

<!-- Male Packages -->
@if($category == 'all' || $category == 'male')
<h3 class="section-title">General Membership Packages</h3>
<div class="row">
  @foreach($members as $member)
    @if($member->category == 'atmiya_student' || $member->category == 'non_atmiya_staff')
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="card package-card shadow-sm">
          <div class="card-body text-center">
            <h5 class="card-title font-weight-bold">{{ $member->name }}</h5>
            <p class="card-text text-muted">{{ $member->description }}</p>
            <div class="package-price mb-3">
              @if($member->discount_price)
                <span class="text-danger font-weight-bold">{{ $member->discount_price }} ₹</span>
                <span class="text-muted text-decoration-line-through">{{ $member->regular_price }} ₹</span>
              @else
                <span class="text-primary font-weight-bold">{{ $member->regular_price }} ₹</span>
              @endif
            </div>
            <a href="{{ route('member.edit', $member->id) }}" class="btn btn-primary btn-sm">
              <i class="fas fa-edit"></i> Edit Package
            </a>
          </div>
        </div>
      </div>
    @endif
  @endforeach
</div>
@endif

<!-- Female Packages -->
@if($category == 'all' || $category == 'female')
<h3 class="section-title mt-5">General Membership + Aerobics/Zumba Packages</h3>
<div class="row">
  @foreach($members as $member)
    @if($member->category == 'atmiya_staff')
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="card package-card shadow-sm">
          <div class="card-body text-center">
            <h5 class="card-title font-weight-bold">{{ $member->name }}</h5>
            <p class="card-text text-muted">{{ $member->description }}</p>
            <div class="package-price mb-3">
              @if($member->discount_price)
                <span class="text-danger font-weight-bold">{{ $member->discount_price }} ₹</span>
                <span class="text-muted text-decoration-line-through">{{ $member->regular_price }} ₹</span>
              @else
                <span class="text-primary font-weight-bold">{{ $member->regular_price }} ₹</span>
              @endif
            </div>
            <a href="{{ route('member.edit', $member->id) }}" class="btn btn-primary btn-sm">
              <i class="fas fa-edit"></i> Edit Package
            </a>
          </div>
        </div>
      </div>
    @endif
  @endforeach
</div>
@endif