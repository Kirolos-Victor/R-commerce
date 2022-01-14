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
                        <h4 class="mb-sm-0 font-size-18">Promo Codes</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Vendor Admin</a></li>
                                <li class="breadcrumb-item active">Promo Codes</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

                    <div class="card">
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                        <div class="card-body">
                            <a class="btn btn-primary mb-3" href="{{route('promo-codes.create')}}">Create Promo Code</a>

                            <div class="table-responsive">
                                <table class="table mb-0">

                                    <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Code</th>
                                        <th>Type</th>
                                        <th>Value</th>
                                        <th>Users Limit</th>
                                        <th>Starting Date</th>
                                        <th>Ending Date</th>
                                        <th>Usage</th>
                                        <th>Minimum Total Cart Price</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($promoCodes as $promoCode)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$promoCode->code}}</td>
                                        <td>{{$promoCode->type}}</td>
                                        <td>{{$promoCode->value}}</td>
                                        <td>{{$promoCode->user_limit}}</td>
                                        <td>{{substr($promoCode->start_date,0,10)}}</td>
                                        <td>{{substr($promoCode->end_date,0,10)}}</td>
                                        <td>{{$promoCode->usage}}</td>
                                        <td>{{$promoCode->minimum_total_cart_price}}</td>
                                        <td>
                                            <div class="row">
                                                <a class="w-50 col-6 btn btn-primary" href="{{route('promo-codes.edit',$promoCode->id)}}" >Update</a>
                                                <form class="col-6" action="{{route('promo-codes.destroy',$promoCode->id)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger deleteModal">Delete</button>
                                                </form>
                                                </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                            <div class="d-flex justify-content-between align-items-center flex-wrap" style="position: relative;top: 0;bottom: 0;left: 0; right: 0; width: 200px; height: 100px; margin: auto;">
                                <div class="d-flex flex-wrap mr-3">

                                    {{$promoCodes->links('vendor.pagination.custom')}}

                                </div>
                            </div>
                    </div>
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->


    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <script>document.write(new Date().getFullYear())</script> © Skote.
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end d-none d-sm-block">
                        Design & Develop by Themesbrand
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- end main content-->
@endsection
@section('scripts')
    <script>
        $('.deleteModal').on('click',function (e) {
            e.preventDefault();
            var form = e.target.form; // storing the form
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    form.submit();
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
        })
    </script>
@endsection
