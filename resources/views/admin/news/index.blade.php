@extends('layouts.auth') 
@section('content') 

<div class="container">
 <div class="row">
  <div class="pull-left"  align="center">
    <h2>Admin News Shows</h2>
  </div>

</div>

@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
             <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
<div class="row">
  <div class="col-sm-12">
    <table class="table">
      <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Details</th>
        <th>Image</th>
        <th>Action.</th>
      </tr>
      @foreach($news as $value)
      <tr class = "text-center">
        <td>{{ $value->id }}</td>
        <td>{{ $value->title }}</td>
        <td>{{ $value->details }}</td>
        <td><img src="public/image/{{ $value->image }}" height="30px" width="30px" /> </td>
        <td>
            <a class="btn btn-primary" href="{{route('News.changestatus',$value->id)}}">Status</a>
        </td>
     </tr>
     @endforeach
   </table>
 </div>
</div>
</div>
@endsection