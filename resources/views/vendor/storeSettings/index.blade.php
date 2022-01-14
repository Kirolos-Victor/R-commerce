@extends('layouts.vendor')
@section('content')
    <!-- end page title -->

    <div class="row mb-3" style="margin-top: 100px;">
        <div class="col-12">
            <div class="card">
                @isset($storeSetting)
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

                <form action="{{route('store-settings.update',$storeSetting->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                <div class="card-body">

                    <h3 class="card-title mb-3">Store Settings</h3>


                    <div class="mb-3 row">
                        <label for="english-name" class="col-md-2 col-form-label">English Name</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="{{$storeSetting->name_en}}"
                                   id="english-name" name="name_en">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="ar-name" class="col-md-2 col-form-label">Arabic Name</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="{{$storeSetting->name_ar}}"
                                   id="ar-name" name="name_ar">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="meta-description" class="col-md-2 col-form-label">Meta Description</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="{{$storeSetting->meta_description}}"
                                   id="meta-description" name="meta_description">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="phone" class="col-md-2 col-form-label">Phone</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="{{$storeSetting->phone}}"
                                   id="phone" name="phone">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="logo" class="col-md-2 col-form-label">Logo</label>
                        <div class="col-md-10">
                            <input class="form-control" type="file"
                                   id="phone" name="logo">
                            <img src="{{asset($storeSetting->logo)}}" style="margin-top: 20px;width: 100px;height: 100px">

                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="cover" class="col-md-2 col-form-label">Cover Image</label>
                        <div class="col-md-10">
                            <input class="form-control" type="file"
                                   id="cover" name="cover_image">
                            <img src="{{asset($storeSetting->cover_image)}}" style="margin-top: 20px;width: 100px;height: 100px">

                        </div>
                    </div>

                </div>
                    <button class="btn btn-primary " style="margin-bottom: 50px;margin-left: 10px;">Update</button>

                </form>

                @endisset

            </div>
        </div> <!-- end col -->
    </div>
    <!-- end row -->
@endsection
