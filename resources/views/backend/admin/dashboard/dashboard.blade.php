@extends('backend.admin.layouts.master')

@section('main-content')
    <div class="container-fluid">
        <div class="row mt-5" style="min-height: 80vh">

            <div class="col-12 col-lg-6">
                <div class="card flex-fill w-100">
                    <div class="card-header">
                        <h5 class="card-title">Number of blogs</h5>
                        <h6 class="card-subtitle text-muted">This line graph depicts the number of blogs created in each month.</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="chartjs-line"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="card flex-fill w-100">
                    <div class="card-header">

                        <h5 class="card-title">Number of blogs</h5>
                        <h6 class="card-subtitle text-muted">This bar graph shows the number of blogs created by individual users.</h6>
                    </div>
                    <div class="card-body">
                        <div class="align-self-center chart chart-lg">
                            <canvas id="chartjs-dashboard-bar"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
@endsection

@push('script')
    <script>
        var users = <?php echo json_encode($fname); ?>; 
        var blogs = <?php echo json_encode($blog); ?>; 
        var count = <?php echo json_encode($count); ?>; 
    </script>

    <script src="{{ asset('/admin/js/bar-chart.js') }}"></script>   
    <script src="{{ asset('/admin/js/line-chart.js') }}"></script>   
@endpush
