@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Quản lí phim</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (!isset($movie))
                            {!! Form::open(['route' => 'movie.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                        @else
                            {!! Form::open(['route' => ['movie.update', $movie->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}
                        @endif
                        <div class="form-group">
                            {!! Form::label('title', 'Tiêu đề', []) !!}
                            {!! Form::text('title', isset($movie) ? $movie->title : '', [
                                'class' => 'form-control',
                                'placeholder' => 'Nhập vào dữ liệu',
                                'id' => 'slug',
                                'onkeyup' => 'ChangeToSlug()',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Time', 'Thời lượng phim', []) !!}
                            {!! Form::text('time_movie', isset($movie) ? $movie->time_movie : '', [
                                'class' => 'form-control',
                                'placeholder' => 'Nhập vào dữ liệu',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Tên tiếng Anh', 'Tên tiếng Anh', []) !!}
                            {!! Form::text('name_movie', isset($movie) ? $movie->name_movie : '', [
                                'class' => 'form-control',
                                'placeholder' => 'Nhập vào dữ liệu',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('slug', 'Slug', []) !!}
                            {!! Form::text('slug', isset($movie) ? $movie->slug : '', [
                                'class' => 'form-control',
                                'placeholder' => 'Nhập vào dữ liệu',
                                'id' => 'convert_slug',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('description', 'Mô tả', []) !!}
                            {!! Form::textarea('description', isset($movie) ? $movie->description : '', [
                                'style' => 'resize:none',
                                'class' => 'form-control',
                                'placeholder' => 'Nhập vào dữ liệu',
                                'id' => 'description',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('tags', 'Tags phim', []) !!}
                            {!! Form::textarea('tags', isset($movie) ? $movie->tags : '', [
                                'style' => 'resize:none',
                                'class' => 'form-control',
                                'placeholder' => 'Nhập vào dữ liệu',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Actice', 'Trạng thái', []) !!}
                            {!! Form::select('status', ['1' => 'Hiện thị', '0' => 'Không'], isset($movie) ? $movie->status : '', [
                                'class' => 'form-control',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Resolution', 'Độ phân giải', []) !!}
                            {!! Form::select(
                                'resolution',
                                ['0' => '2K', '1' => 'Full HD', '2' => 'HD', '3' => 'SD'],
                                isset($movie) ? $movie->resolution : '',
                                [
                                    'class' => 'form-control',
                                ],
                            ) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Subtitle', 'Phụ đề', []) !!}
                            {!! Form::select('subtitle', ['0' => 'Vietsub', '1' => 'Thuyết minh'], isset($movie) ? $movie->subtitle : '', [
                                'class' => 'form-control',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Category', 'Danh mục', []) !!}
                            {!! Form::select('category_id', $category, isset($movie) ? $movie->category_id : '', [
                                'class' => 'form-control',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Country', 'Quốc gia', []) !!}
                            {!! Form::select('country_id', $country, isset($movie) ? $movie->country_id : '', [
                                'class' => 'form-control',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Genre', 'Thể loại', []) !!}
                            {!! Form::select('genre_id', $genre, isset($movie) ? $movie->genre_id : '', [
                                'class' => 'form-control',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Hot', 'Hot', []) !!}
                            {!! Form::select('hotmovie', ['1' => 'Có', '0' => 'Không'], isset($movie) ? $movie->hotmovie : '', [
                                'class' => 'form-control',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Image', 'Hình ảnh', []) !!}
                            {!! Form::file('image', ['class' => 'form-control']) !!}
                            @if (isset($movie) && $movie->image)
                                <img src="{{ asset('uploads/movie/' . $movie->image) }}" alt="" width="150px">
                            @endif
                        </div>
                        <br>
                        @if (!isset($movie))
                            {!! Form::submit('Thêm dữ liệu', ['class' => 'btn btn-success']) !!}
                        @else
                            {!! Form::submit('Cập nhật', ['class' => 'btn btn-success']) !!}
                        @endif

                        {!! Form::close() !!}
                    </div>
                </div>
                <br>
                <table class="table" id="tablemovie">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên phim</th>
                            <th scope="col">Tên phim tiếng Anh</th>
                            <th scope="col">Tags</th>
                            <th scope="col">Thời lượng</th>
                            <th scope="col">Hình ảnh</th>
                            <th scope="col">Hot</th>
                            <th scope="col">Độ phân giải</th>
                            <th scope="col">Phụ đề</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Mô tả</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Năm</th>
                            <th scope="col">Danh mục</th>
                            <th scope="col">Thể loại</th>
                            <th scope="col">Quốc gia</th>
                            <th scope="col">Thời gian tạo</th>
                            <th scope="col">Thời gian cập nhật</th>
                            <th scope="col">Quản lí</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $key => $cate)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $cate->title }}</td>
                                <td>{{ $cate->name_movie }}</td>
                                <td>{{ $cate->tags }}</td>
                                <td>{{ $cate->time_movie }}</td>
                                <td><img src="{{ asset('uploads/movie/' . $cate->image) }}" alt="" width="150px">
                                </td>
                                <td>
                                    @if ($cate->hotmovie == 0)
                                        Không
                                    @else
                                        Có
                                    @endif
                                </td>
                                <td>
                                    @if ($cate->resolution == 0)
                                        2K
                                    @elseif($cate->resolution == 1)
                                        Full HD
                                    @elseif($cate->resolution == 2)
                                        HD
                                    @elseif($cate->resolution == 3)
                                        SD
                                    @else
                                        Không có độ phân giải
                                    @endif
                                </td>
                                <td>
                                    @if ($cate->subtitle == 0)
                                        Vietsub
                                    @else
                                        Thuyết minh
                                    @endif
                                </td>
                                <td>{{ $cate->slug }}</td>
                                <td>{{ \Illuminate\Support\Str::words($cate->description, 100, '...') }}</td>

                                <td>
                                    @if ($cate->status)
                                        Hiển thị
                                    @else
                                        Không hiển thị
                                    @endif
                                </td>
                                <td>
                                    {!! Form::selectYear('year', 2000, 2024, isset($cate->year) ? $cate->year : '', [
                                        'class' => 'select-year',
                                        'id' => $cate->id,
                                    ]) !!}
                                </td>
                                <td>{{ optional($cate->category)->title ?? 'Không có danh mục' }}</td>
                                <td>{{ optional($cate->genre)->title ?? 'Không có thể loại' }}</td>
                                <td>{{ optional($cate->country)->title ?? 'Không có quốc gia' }}</td>
                                <td>{{ $cate->created_at }}</td>
                                <td>{{ $cate->updated_at }}</td>
                                <td>
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'route' => ['movie.destroy', $cate->id],
                                        'onsubmit' => 'return confirm("Bạn có muốn xóa không?")',
                                    ]) !!}
                                    {!! Form::submit('Xóa', ['class' => 'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                                    <a href="{{ route('movie.edit', $cate->id) }}" class="btn btn-warning">Sửa</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var alert = document.querySelector('.alert-success');
            if (alert) {
                setTimeout(function() {
                    alert.style.display = 'none';
                }, 2000); // 2000ms = 2s
            }
        });
    </script>
@endsection
