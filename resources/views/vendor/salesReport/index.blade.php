@extends('layouts.vendor')
@section('content')
    <!-- Start right Content here -->
    <!-- ============================================================== -->

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Sales Report</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Reports</a></li>
                                <li class="breadcrumb-item active">Sales Report</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- end page title -->
          @php
          $dates=[];
$count=[];
 $months=[];
 $countForMonths=[];
foreach($orders->unique('created_at') as $order)
    {
        $dates[]=$order->created_at;
        $count[]=$orders->where('created_at','=',$order->created_at)->count();

    }
foreach($ordersByMonth->unique('created_month') as $orderByMonth)
    {
        $months[]=$orderByMonth->created_month;
        $countForMonths[]=$ordersByMonth->where('created_month','=',$orderByMonth->created_month)->count();
    }
       // dd( $countForMonths);

              @endphp
            <form class="mb-5" action="{{route('salesReport')}}">
                <h2 class="text-center">Day By Day Sales</h2>
                <div class="row">
                    <div class="col-4">
                        <label>From</label>
                        <input type="date" name="from" class="form-control">
                    </div>
                    <div class="col-4">
                        <label>To</label>
                        <input type="date" name="to" class="form-control">
                    </div>
                    <div class="col-4 mt-4">
                        <button type="submit" class="btn btn-primary w-50">Filter</button>
                    </div>

                </div>
            </form>
            <canvas id="myChart1" width="400" height="150"></canvas>
            <!----------Chart 2 --->

            <form class="mb-5" style="margin-top: 100px;" action="{{route('salesReportByMonth')}}">
                <h2 class="text-center" >Month By Month Sales</h2>

                <div class="row">
                    <div class="col-4">
                        <label>From</label>
                        <input type="month" name="from" class="form-control" >
                    </div>
                    <div class="col-4">
                        <label>To</label>
                        <input type="month" name="to" class="form-control">
                    </div>
                    <div class="col-4 mt-4">
                        <button type="submit" class="btn btn-primary w-50">Filter</button>
                    </div>

                </div>
            </form>

            <canvas id="myChart2" width="400" height="150"></canvas>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        var ctx = document.getElementById('myChart1').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($dates) ?>,
                datasets: [{
                    label: '# of Orders',
                    data:  <?php echo json_encode($count) ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 192, 192, 0.2)',
                        'rgba(153, 192, 192, 0.2)',



                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 192, 192, 0.2)',
                        'rgba(153, 192, 192, 0.2)',

                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
    <script>
        var ctx = document.getElementById('myChart2').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($months) ?>,
                datasets: [{
                    label: '# of Orders',
                    data:  <?php echo json_encode($countForMonths) ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 192, 192, 0.2)',
                        'rgba(153, 192, 192, 0.2)',



                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 192, 192, 0.2)',
                        'rgba(153, 192, 192, 0.2)',

                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>

@endsection
