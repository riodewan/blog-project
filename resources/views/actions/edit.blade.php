@extends('layouts.navbar')

@section('container')
<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Data Blog
                        <a href="{{ route('blog.index') }}" class="btn btn-danger float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                <form action="{{ route('blog.update',$blog->id) }}" method="POST" enctype="multipart/form-data"> 
        @csrf
        @method('PUT')
     
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="nama" value="{{ $blog->nama }}" class="form-control" placeholder="Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Detail:</strong>
                    <textarea class="form-control" style="height:150px" name="deskripsi" placeholder="Detail">{{ $blog->deskripsi }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Image:</strong>
                    <input type="file" name="foto" class="form-control" placeholder="image">
                    <img src="/images/{{ $blog->foto }}" width="300px">
                </div>
                </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
</div>
</div>
@endsection