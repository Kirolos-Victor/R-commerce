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
                        <h4 class="mb-sm-0 font-size-18">Abandoned Carts</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                                <li class="breadcrumb-item active">Abandoned Carts</li>
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

                    <div class="table-responsive">
                        <table class="table mb-0">

                            <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>User Name</th>
                                <th>User E-mail</th>
                                <th>User Phone</th>
                                <th>Created Date</th>
                                <th>Order Details</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($carts->count() === 0)
                                <tr>

                                    <th colspan="10" class="text-center">There are no abandoned carts yet!</th>
                                </tr>
                            @else
                            @foreach($carts as $cart)
                                <tr>
                                    <th>{{$loop->index+1}}</th>
                                    <td>{{$cart->user->first_name.' '.$cart->user->last_name}}</td>
                                    <td>{{$cart->user->email}}</td>
                                    <td>{{$cart->user->phone}}</td>
                                    <td>{{$cart->created_at}}</td>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary btn-sm btn-rounded"
                                                data-bs-toggle="modal"
                                                data-bs-target="{{'.orderdetailsModal'.$loop->index}}">
                                            View Details
                                        </button>
                                        <!-- Modal -->
                                        <div class="{{'modal fade orderdetailsModal'.$loop->index}}" tabindex="-1"
                                             role="dialog" aria-labelledby="{{"orderdetailsModalLabel".$loop->index}}"
                                             aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="{{"orderdetailsModalLabel".$loop->index}}">Order
                                                            Details</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <div class="table-responsive">
                                                            <table class="table align-middle table-nowrap">
                                                                <thead>
                                                                <tr>
                                                                    <th scope="col">Product Name</th>
                                                                    <th>Quantity</th>
                                                                    <th scope="col">Price</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>

                                                                @foreach($cart->cart_data as $item)

                                                                    <tr>
                                                                        {{--                                                                        <th scope="row">--}}
                                                                        {{--                                                                            <div>--}}
                                                                        {{--                                                                                <img src="assets/images/product/img-7.png" alt="" class="avatar-sm">--}}
                                                                        {{--                                                                            </div>--}}
                                                                        {{--                                                                        </th>--}}
                                                                        <td>
                                                                            <div>
                                                                                <h5 class="text-truncate font-size-14">{{$item->name}}</h5>
                                                                                {{--                                                                                <p class="text-muted mb-0">${{$item->price.'x'.$item->quantity}}</p>--}}
                                                                            </div>
                                                                        </td>
                                                                        <td>{{$item->quantity}}</td>
                                                                        <td>$ {{$item->price * $item->quantity}}</td>
                                                                    </tr>

                                                                @endforeach
                                                                @php
                                                                    $totalCartPayment=0;

                                                                    foreach ($cart->cart_data as $data)
                                                                    {
                                                                    $totalCartPayment=$totalCartPayment+($data->price * $data->quantity);
                                                                    }
                                                                @endphp
                                                                <tr>
                                                                    <td colspan="2">
                                                                        <h6 class="m-0 text-right">Sub Total:</h6>
                                                                    </td>
                                                                    <td>
                                                                        $ {{$totalCartPayment}}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2">
                                                                        <h6 class="m-0 text-right">Shipping:</h6>
                                                                    </td>
                                                                    <td>
                                                                        Free
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2">
                                                                        <h6 class="m-0 text-right">Total:</h6>
                                                                    </td>
                                                                    <td>
                                                                        ${{$totalCartPayment}}
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end modal -->
                                    </td>
                                </tr>

                            @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="d-flex justify-content-between align-items-center flex-wrap"
                     style="position: relative;top: 0;bottom: 0;left: 0; right: 0; width: 200px; height: 100px; margin: auto;">
                    <div class="d-flex flex-wrap mr-3">

                        {{$carts->links('vendor.pagination.custom')}}

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
                    © Skote.
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
        })
    </script>
@endsection
