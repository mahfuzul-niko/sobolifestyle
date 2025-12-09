@extends('admin.layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Feature Video</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">feature-video</li>
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
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    <form action="{{ route('setting.store.feature.video') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Feature Video Title</label>
                            <input type="text" name="feature_video_title" class="form-control"
                                placeholder="Enter Video Title" required>
                        </div>

                        <div class="form-group">
                            <label>Feature Video URL</label>
                            <input type="url" name="feature_video_url" class="form-control"
                                placeholder="Enter Video URL" required>
                        </div>

                        <div class="form-group">
                            <label>Feature Video File</label>
                            <input type="file" name="feature_video" class="form-control"
                                accept="video/mp4,video/webm,video/ogg" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="card">
                <div class="card-header">
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Title</th>
                                <th>Video URL</th>
                                <th>Video</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($feature_videos as $key => $video)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $video->feature_video_title }}</td>
                                    <td>{{ $video->feature_video_url }}</td>
                                    <td>
                                        <video width="320" height="240" controls>
                                            <source src="{{ asset($video->feature_video) }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        });
    </script>
@endsection
