@extends('layouts.admin')
@section('content')
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Vendors</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                                <li class="breadcrumb-item active">Vendors</li>
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
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        <div class="card-body">
                            <a class="btn btn-primary mb-3" href="{{route('vendors.create')}}">Create Vendor</a>

                            <div class="table-responsive">
                                <table class="table mb-0">

                                    <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>English Name</th>
                                        <th>Arabic Name</th>
                                        <th>Location</th>
                                        <th>Country</th>
                                        <th>Supplier Code</th>
                                        <th>Starting Working Time</th>
                                        <th>Ending Working Time</th>
                                        <th>Starting Delivery Time</th>
                                        <th>Ending Delivery Time</th>
                                        <th>Pre-Order Availability</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($vendors as $vendor)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$vendor->name_en}}</td>
                                        <td>{{$vendor->name_ar}}</td>
                                        <td>{{$vendor->location}}</td>
                                        <td>{{$vendor->country->name_en}}</td>
                                        <td>{{$vendor->supplier_code}}</td>
                                        <td>{{$vendor->start_working_hours}}</td>
                                        <td>{{$vendor->end_working_hours}}</td>
                                        <td>{{$vendor->start_delivery_time}}</td>
                                        <td>{{$vendor->end_delivery_time}}</td>
                                        <td>{{$vendor->preorder_availability == 1?"Available":"Not Available"}}</td>

                                        <td>{{$vendor->active == 1?"Active":"Not Active"}}</td>
                                        <td>
                                            <div class="row">


                                                <a class="w-75 col-6 btn btn-primary" href="{{route('vendors.edit',$vendor->id)}}" >Update</a>
                                                <form class="col-6" action="{{route('vendors.destroy',$vendor->id)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button  class="btn btn-danger deleteModal">Delete</button>
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

                                    {{$vendors->links('vendor.pagination.custom')}}

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
