@extends('layouts.auth')
@section('content')
 <div class="container">
 <h1>Add New News</h1>
<hr>
<div class="row">
<div class="col-xs-6 col-sm-6 col-md-6">
<form action="{{ route('News.store') }}" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
    <div class="form-group">
        <label for="title"> Title</label>
        <input type="text" class="form-control" id="Title"  name="title" value="{{ old('title') }}">
    </div>

    <div class="form-group">
        <label for="details"> Details</label>
        <input type="text" class="form-control" id="details" name="details" >
    </div>
     <div class="form-group">
        <label for="image"> image</label>
        <input type="file" class="form-control" id="image"  name="image">
    </div>
      @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
</div>
</div>

@endsection