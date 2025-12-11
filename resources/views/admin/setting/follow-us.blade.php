@extends('admin.layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Follow Us Images</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">follow-us-image</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">

                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach ($followImages as $item)
                            <div class="col-md-6 col-lg-3 mb-4">
                                <div class="card shadow-sm">
                                    <div class="card-header text-center" style="font-weight: bold;">
                                        {{ ucfirst(str_replace('_', ' ', $item->key)) }}
                                    </div>

                                    <div class="card-body">
                                        <form action="{{ route('setting.follow-us.update', $item->key) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <!-- Image Preview -->
                                            <div class="text-center mb-3">
                                                @if ($item->image)
                                                    <img src="{{ asset('images/follow_us/' . $item->image) }}"
                                                        class="img-fluid rounded mb-2" style="max-height: 120px;">
                                                @else
                                                    <div class="bg-light border rounded p-3">
                                                        <small>No image uploaded</small>
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Upload Input -->
                                            <div class="form-group mb-3">
                                                <label class="form-label">Upload Image</label>
                                                <input type="file" name="image" class="form-control">
                                            </div>

                                            <!-- Link Input -->
                                            <div class="form-group mb-3">
                                                <label class="form-label">Link</label>
                                                <input type="text" name="link" value="{{ $item->link }}"
                                                    class="form-control" placeholder="Enter link">
                                            </div>

                                            <button type="submit" class="btn btn-primary btn-block w-100">
                                                Save
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>


                </div>
            
            </div>
            <!-- /.card -->
        </div>
    </section>
@endsection
