@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <a href="{{ route('movie.create') }}" class="btn btn-info">Quay lại</a>
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
                            <th scope="col">Chất lượng</th>
                            <th scope="col">Phụ đề</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Mô tả</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Năm</th>
                            {{-- <th scope="col">Top views</th> --}}
                            <th scope="col">Season</th>
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
                                        Trailer
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
                                    <form method="post">
                                        {!! Form::selectYear('year', 2010, 2024, isset($cate->year) ? $cate->year : '', [
                                            'class' => 'select-year',
                                            'id' => $cate->id,
                                        ]) !!}
                                    </form>
                                </td>
                                {{-- <td> {!! Form::select(
                                    'topview',
                                    ['0' => 'Ngày', '1' => 'Tuần', '2' => 'Tháng'],
                                    isset($cate->topview) ? $cate->topview : '',
                                    [
                                        'class' => 'select-topview',
                                        'data-id' => $cate->id,
                                    ],
                                ) !!}
                                </td> --}}
                                <td>
                                    <form method="post">
                                        @csrf
                                        {!! Form::selectRange('season', 0, 20, isset($cate->season) ? $cate->season : '', [
                                            'class' => 'select-season',
                                            'id' => $cate->id,
                                        ]) !!}
                                    </form>
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
