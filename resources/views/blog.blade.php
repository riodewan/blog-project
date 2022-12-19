@extends('layouts.navbar')

@section('container')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
       {{ session ('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
     </div>
@endif

<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Data Blog
                        <a href="{{ route('blog.create') }}" class="btn btn-primary float-end">Add Blog</a>
                    </h4>
                </div>
                <div class="card-body">
        <table class="table table-bordered text-center">
        <tr>
            <th width="100px">No</th>
            <th>Nama</th>
            <th>Deskripsi</th>
            <th>Gambar</th>
            <th>Action</th>
        </tr>
        @foreach ($blogs as $blog)
        <tr>
            <th>{{ ++$i }} </th>
            <td>{{$blog -> nama}}</td>
            <td>{{$blog -> deskripsi}}</td>
            <td><img src="/images/{{ $blog->foto }}" alt="" srcset="" width="100px"></td>
            <td><form action="{{ route('blog.destroy', $blog->id) }}" method="POST">
                                            <a href="{{ route('blog.edit', $blog->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form></td>
        </tr>
        @endforeach
</table>
</div>
@endsection
