@extends('admins/layout')
@section('content')

<div class="content">

    <div class="row gy-3 mb-6 justify-content-between">
        <div class="col-md-9 col-auto">
            <h2 class="mb-2 text-1100">
                <!-- <span id="greetings"></span> -->
            </h2>
            <h5 class="text-700 fw-semi-bold">Here’s what’s going in your software right now</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="d-flex align-items-center pointerhand" onclick="redirecttopage('admin/user_list')">
                        <span class="fs-4 lh-1 uil uil-users-alt text-success-500"></span>
                        <div class="ms-2">
                            <h2 class="mb-0">{{ App\Models\VisitorModel::where('created_at',date('Y-m-d'))->where('flag','!=','2')->count() }}<span class="fs-1 fw-semi-bold text-900 ms-2">Today <span style="font-size: 10px;">({{date('d-m-Y')}})</span></span>
                            </h2> 
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="d-flex align-items-center pointerhand" onclick="redirecttopage('admin/user_list')">
                        <span class="fs-4 lh-1 uil uil-users-alt text-success-500"></span>
                        <div class="ms-2">
                            <h2 class="mb-0">{{ App\Models\VisitorModel::where('flag','!=','2')->count() }}<span class="fs-1 fw-semi-bold text-900 ms-2">Total Data</span>
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="d-flex align-items-center pointerhand" onclick="redirecttopage('admin/user_list')">
                        <span class="fs-4 lh-1 uil uil-users-alt text-success-500"></span>
                        <div class="ms-2">
                            <h2 class="mb-0">{{ App\Models\VisitorModel::where('flag','0')->count() }}<span class="fs-1 fw-semi-bold text-900 ms-2">Active Data</span>
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="d-flex align-items-center pointerhand" onclick="redirecttopage('admin/user_list')">
                        <span class="fs-4 lh-1 uil uil-users-alt text-success-500"></span>
                        <div class="ms-2">
                            <h2 class="mb-0">{{ App\Models\VisitorModel::where('flag','1')->count() }}<span class="fs-1 fw-semi-bold text-900 ms-2">Inactive Data</span>
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
        </div>
    </div>
    <div class="bg-white pt-7 pb-3 px-3 border-y border-300">
        <div class="row">
            <h3>
                <center>Registerd Data Report</center>
            </h3>
            <div class="col-12 col-xl-8 col-xxl-8">
                <div class="chart-container">
                    <canvas id="chart_1"></canvas>
                </div>
            </div>
            <div class="col-12 col-xl-4 col-xxl-4">
                <h3 class="text-1100 text-nowrap">Day wise Data</h3>
                <div class="d-flex align-items-center justify-content-between">
                    <p class="mb-0 fw-bold">Date </p>
                    <p class="mb-0 fs--1">Total count <span class="fw-bold">{{ $access_details ?? ''}}</span></p>
                </div>
                <hr class="bg-200 mb-2 mt-2" />

                @php
                $access = DB::table('registration_data')
                ->select(DB::raw("COUNT(id) as count"), 'created_at')
                ->where('flag','!=','2')
                ->groupBy('created_at')
                ->pluck('count','created_at');

                $accesslabel = $access->keys();
                $accessvalue = $access->values();
                @endphp


                @if(!empty($access))
                @foreach($access as $key => $value)
                <div class="d-flex align-items-center mb-2">
                    <div style="border: 1px solid black; height: 10px; margin-right: 7px; width: 20px;"></div>
                    <p class="mb-0 fw-semi-bold text-900 lh-sm flex-1">{{ $key }}</p>
                    <h5 class="mb-0 text-900">{{ $value }}</h5>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    var labels = $("#labels").val();

    var data = {
        labels: {!! $accesslabel !!},
        datasets: [{
            label: "Date Wise Report",
            backgroundColor: "#1eb048",
            borderColor: '#000',
            borderWidth: 1,
            hoverBackgroundColor: "#1eb048",
            hoverBorderColor: '#000',
            data: {!! $accessvalue !!},
        }]
    };

    var option = {
        scales: {
            yAxes: [{
                stacked: true,
                gridLines: {
                    display: true,
                    color: "rgba(255,99,132,0.2)"
                }
            }],
            xAxes: [{
                gridLines: {
                    display: false
                }
            }]
        }
    };

    Chart.Bar('chart_1', {
        options: option,
        data: data
    });
</script>

@endsection()