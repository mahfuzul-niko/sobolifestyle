@extends('admin.layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Bottom Sliders</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!-- Modal -->
    <div class="modal fade" id="bottomslideimage" tabindex="-1" role="dialog" aria-labelledby="bottomslideimageLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header text-light bg-dark">
                    <h5 class="modal-title" id="bottomslideimageLabel">Add New Slider</h5>
                    <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('slider.bottom.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><span class="text-danger">*</span>Slide Images (1177 x 502px)</label>
                                    <input type="file" name="image"
                                        class="form-control @error('image') is-invalid @enderror" required>
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Link</label>
                                    <input type="text" name="link"
                                        class="form-control @error('link') is-invalid @enderror" required value="{{ $bottomSlider ? $bottomSlider->link : '' }}">
                                    @error('link')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header text-right">
                    <button type="button" class="btn btn-success btn-rounded" data-toggle="modal"
                        data-target="#bottomslideimage"><i class="fas fa-plus"></i> Add Bottom Slide Iage</button>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="5%">S.N</th>
                                <th width="30%">Image</th>
                                <th width="30%">link</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if ($bottomSlider)
                                <tr>
                                    <td>1</td>
                                    <td><img class="shadow rounded border p-1"
                                            src="{{ asset('images/slider/' . $bottomSlider->image) }}" width="100%">
                                    </td>
                                    <td>{{ $bottomSlider->link }}</td>

                                </tr>
                            @endif
                        </tbody>

                    </table>
                </div>
                <!-- /.card-body -->
            </div>

        </div>
        <!-- /.card -->
        </div>
    </section>
@endsection

@section('scripts')
    <script></script>
@endsection
