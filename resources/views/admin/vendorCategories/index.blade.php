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
                        <h4 class="mb-sm-0 font-size-18">Vendor Categories</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                                <li class="breadcrumb-item active">Vendor Categories</li>
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
                    <a class="btn btn-primary mb-3" href="{{route('vendor-category.create')}}">Create Vendor
                        Category</a>

                    <div class="table-responsive">
                        <table class="table mb-0">

                            <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>English Name</th>
                                <th>Arabic Name</th>
                                <th>Image</th>
                                <th>Actions</th>
                                <th>Acive State</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($vendorCategories as $vendorCategory)
                                <tr>
                                    <th>{{$loop->index+1}}</th>
                                    <td>{{$vendorCategory->name_en}}</td>
                                    <td>{{$vendorCategory->name_ar}}</td>
                                    <td>
                                        @if(!in_array($vendorCategory->id,[1,2,3]))
                                            <img style="width: 150px; height: 100px;"
                                                 src="{{asset($vendorCategory->image)}}"></td>
                                    @else
                                        <a class="w-25 col-6 btn btn-warning"
                                           href="javascript:void(0)">!</a>
                                    @endif

                                    <td>
                                        <div class="row">

                                            {{--skip basic categoris--}}
                                            @if(!in_array($vendorCategory->id,[1,2,3]))
                                                <a class="w-25 col-6 btn btn-primary"
                                                   href="{{route('vendor-category.edit',$vendorCategory->id)}}">Update</a>
                                            @else
                                                <a class="w-25 col-6 btn btn-danger"
                                                   href="javascript:void(0)">Forbidden</a>
                                            @endif
                                            <form class="col-6"
                                                  action="{{route('vendor-category.destroy',$vendorCategory->id)}}"
                                                  method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger deleteModal">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <form class="col-6"
                                                  action="{{route('vendor-category.toggleActivation',$vendorCategory->id)}}"
                                                  method="POST">
                                                @csrf
                                                @method('POST')
                                                @if($vendorCategory->is_active)
                                                    <button class="btn btn-danger toggleActivationModal">DeActivate
                                                    </button>
                                                @else
                                                    <button class="btn btn-success toggleActivationModal">Activate
                                                    </button>
                                                @endif

                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="d-flex justify-content-between align-items-center flex-wrap"
                     style="position: relative;top: 0;bottom: 0;left: 0; right: 0; width: 200px; height: 100px; margin: auto;">
                    <div class="d-flex flex-wrap mr-3">

                        {{$vendorCategories->links('vendor.pagination.custom')}}

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
                    <script>document.write(new Date().getFullYear())</script>
                    ?? Skote.
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
        $('.deleteModal').on('click', function (e) {
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
        });
        $('.toggleActivationModal').on('click', function (e) {
            e.preventDefault();
            var form = e.target.form; // storing the form
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, change the activation state of it!'
            }).then((result) => {
                if (result.value) {
                    form.submit();
                    Swal.fire(
                        'Done!',
                        'State changed done.',
                        'success'
                    )
                }
            })
        });

    </script>
@endsection
