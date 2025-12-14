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

                            <!-- Desktop Image -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><span class="text-danger">*</span>Slide Image (1177 x 502px)</label>
                                    <input type="file" name="image"
                                        class="form-control @error('image') is-invalid @enderror"
                                        {{ $bottomSlider ? '' : 'required' }}>
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Desktop Link -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Link</label>
                                    <input type="text" name="link"
                                        class="form-control @error('link') is-invalid @enderror"
                                        value="{{ $bottomSlider ? $bottomSlider->link : '' }}">
                                    @error('link')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Mobile Image -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Mobile Slide Image (e.g., 600 x 400px)</label>
                                    <input type="file" name="m_image"
                                        class="form-control @error('m_image') is-invalid @enderror">
                                    @error('m_image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Mobile Link -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Mobile Link</label>
                                    <input type="text" name="m_link"
                                        class="form-control @error('m_link') is-invalid @enderror"
                                        value="{{ $bottomSlider ? $bottomSlider->m_link : '' }}">
                                    @error('m_link')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Submit Button -->
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
                                <th width="25%">Desktop Image</th>
                                <th width="25%">Mobile Image</th>
                                <th width="20%">Desktop Link</th>
                                <th width="20%">Mobile Link</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($bottomSlider)
                                <tr>
                                    <td>1</td>

                                    <!-- Desktop Image -->
                                    <td>
                                        @if ($bottomSlider->image)
                                            <img class="shadow rounded border p-1"
                                                src="{{ asset('images/slider/' . $bottomSlider->image) }}" width="100%">
                                        @else
                                            N/A
                                        @endif
                                    </td>

                                    <!-- Mobile Image -->
                                    <td>
                                        @if ($bottomSlider->m_image)
                                            <img class="shadow rounded border p-1"
                                                src="{{ asset('images/slider/' . $bottomSlider->m_image) }}" width="100%">
                                        @else
                                            N/A
                                        @endif
                                    </td>

                                    <!-- Desktop Link -->
                                    <td>{{ $bottomSlider->link ?? 'N/A' }}</td>

                                    <!-- Mobile Link -->
                                    <td>{{ $bottomSlider->m_link ?? 'N/A' }}</td>
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
