@extends('layouts.auth')
@section('content')
<h1>Edit News</h1>
<hr>
<div class="container">
 <div class="row">
<div class="col-xs-6 col-sm-6 col-md-6">
 @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

  <form action="{{ route('News.update',$news->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
        @method('PUT') 
  <div class="form-group">
        <label for="title">news Title</label>
        <input type="text" value="{{$news->title}}" class="form-control" id="newsTitle"  name="title" >
    </div>
    <div class="form-group">
        <label for="details">news details</label>
        <textarea class="form-control" style="height:150px" name="details" placeholder="Detail">{{ $news->details }}</textarea>
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