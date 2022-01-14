@extends('layouts.vendor')
@section('content')
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="page-content" >
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Addons</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Vendor Admin</a></li>
                                <li class="breadcrumb-item active">Addons</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

                    <div class="card">
                      @if(\Illuminate\Support\Facades\Request::has('create-success'))
                          <div class="alert alert-success">
                              You have created the Addon successfully
                          </div>
                        @endif
                          @if(\Illuminate\Support\Facades\Request::has('update-success'))
                              <div class="alert alert-success">
                                  You have updated the Addon successfully
                              </div>
                          @endif
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                        <div class="card-body">
                            <a class="btn btn-primary mb-3" href="{{route('addons.create')}}">Create Addon</a>

                            <div class="table-responsive">
                                <table class="table mb-0">

                                    <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>English Name</th>
                                        <th>Arabic Name</th>
                                        <th>Vendor Name</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($addons as $addon)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$addon->name_en}}</td>
                                        <td>{{$addon->name_ar}}</td>
                                        <td>{{$addon->vendor->name_en}}</td>
                                        <td>
                                            <div class="row">


                                                <a class="w-50 col-6 btn btn-primary" href="{{route('addons.edit',$addon->id)}}" >Update</a>
                                                <form class="col-6" action="{{route('addons.destroy',$addon->id)}}" method="POST">
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

                                    {{$addons->links('vendor.pagination.custom')}}

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
