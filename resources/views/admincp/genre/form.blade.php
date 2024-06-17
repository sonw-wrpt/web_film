@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Quản lí thể loại</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (!isset($genre))
                            {!! Form::open(['route' => 'genre.store', 'method' => 'POST']) !!}
                        @else
                            {!! Form::open(['route' => ['genre.update', $genre->id], 'method' => 'PUT']) !!}
                        @endif
                        <div class="form-group">
                            {!! Form::label('title', 'Tiêu đề', []) !!}
                            {!! Form::text('title', isset($genre) ? $genre->title : '', [
                                'class' => 'form-control',
                                'placeholder' => 'Nhập vào dữ liệu',
                                'id' => 'slug',
                                'onkeyup' => 'ChangeToSlug()',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('slug', 'Slug', []) !!}
                            {!! Form::text('slug', isset($genre) ? $genre->slug : '', [
                                'class' => 'form-control',
                                'placeholder' => 'Nhập vào dữ liệu',
                                'id' => 'convert_slug',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('description', 'Mô tả', []) !!}
                            {!! Form::textarea('description', isset($genre) ? $genre->description : '', [
                                'style' => 'resize:none',
                                'class' => 'form-control',
                                'placeholder' => 'Nhập vào dữ liệu...',
                                'id' => 'description',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Actice', 'Trạng thái', []) !!}
                            {!! Form::select('status', ['1' => 'Hiện thị', '0' => 'Không'], isset($genre) ? $genre->status : '', [
                                'class' => 'form-control',
                            ]) !!}
                        </div><br>
                        @if (!isset($genre))
                            {!! Form::submit('Thêm dữ liệu', ['class' => 'btn btn-success']) !!}
                        @else
                            {!! Form::submit('Cập nhật', ['class' => 'btn btn-success']) !!}
                        @endif

                        {!! Form::close() !!}
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tiêu đề</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Mô tả</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Quản lí</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $key => $cate)
                            <tr>
                                <th scope="row">{{ $key }}</th>
                                <td>{{ $cate->title }}</td>
                                <td>{{ $cate->slug }}</td>
                                <td>{{ $cate->description }}</td>
                                <td>
                                    @if ($cate->status)
                                        Hiển thị
                                    @else
                                        Không hiển thị
                                    @endif
                                </td>
                                <td>
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'route' => ['genre.destroy', $cate->id],
                                        'onsubmit' => 'return confirm("Xóa nhé?")',
                                    ]) !!}
                                    {!! Form::submit('Xóa', ['class' => 'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                                    <a href="{{ route('genre.edit', $cate->id) }}" class="btn btn-warning">Sửa</a>
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
