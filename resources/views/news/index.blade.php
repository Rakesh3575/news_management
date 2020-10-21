@extends('layouts.auth') 
@section('content') 
 <!--   -->
         <?php 
 // DB::enableQueryLog();
 //    Auth::user()->likes()->where('news_id', $news[1]->id)->first()->like == 0;
 // dd(DB::getQueryLog()); 
 ?>

 
<div class="container">
 <div class="row">
        <div class="pull-left"  align="center">
            <h2>News Management</h2>
        </div>
        <div class="col-lg-12 margin-tb" align="right">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('News.create') }}"> Create New News</a>
            </div>
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
          <th>Like .</th>
        </tr>
        @foreach($news as $value)
  <div class="post" id="{{ $value->id }}" >
          <tr class = "text-center">
            <td>
             {{ $value->id }}</td>
            <td>{{ $value->title }}</td>
            <td>{{ $value->details }}</td>
            <td><img src="public/image/{{ $value->image }}" height="30px" width="30px" /> </td>
             <td> 
              @if ($value->user_id == Auth::id())
 				   <form action="{{ route('News.destroy',$value->id) }}" method="POST">
 				   		<a class="btn btn-primary" href="{{route('News.edit',$value->id)}}">Edit</a>
 						@csrf @method('DELETE')
   						<button type="submit" class="btn btn-danger">Delete</button>
                 </form> 
              @endif
             </td>
             <td> 
              <div class="interaction">
                <a href="#" class="btn btn-xs btn-warning like" id="<?php echo $value->id; ?>" data-index="<?php echo $value->id; ?>" name="tab"> {{ Auth::user()->likes()->where('news_id', $value->id)->first() ? Auth::user()->likes()->where('news_id', $value->id)->first()->like == 1 ? 'You like this post' : 'Like' : 'Like'  }}</a>|
                <a href="#" class="btn btn-xs btn-danger like" id="<?php echo $value->id; ?>" data-index="<?php echo $value->id; ?>" name="tab">{{ Auth::user()->likes()->where('news_id', $value->id)->first() ? Auth::user()->likes()->where('news_id', $value->id)->first()->like == 0 ? 'You dont like this post' : 'Dislike' : 'Dislike'  }}</a>
              </div>
             </td>
          </tr>
      </div>
        @endforeach
      </table>
    </div>
  </div>
</div>
@endsection
 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
 <script>
      var token = '{{ Session::token() }}';
      var urlLike = '{{ route('like') }}';
</script>



<script type="text/javascript">
 
var news_id = 0;
$( document ).ready(function() {
   $("a[name=tab]").on("click", function (event) { 
 //});
 //$('.like').on('click', function(event) {
    event.preventDefault();
    var news_id = $(this).data("index"); 
   //news_id = event.target.parentNode.parentNode.dataset['news_id'];
 //        alert(news_id+"ss");
    var isLike = event.target.previousElementSibling == null;
        alert(isLike);
 
    $.ajax({
        method: 'POST',
        url: urlLike,
        data: {isLike: isLike, news_id: news_id, _token: token}
    })
        .done(function() {
            event.target.innerText = isLike ? event.target.innerText == 'Like' ? 'You like this post' : 'Like' : event.target.innerText == 'Dislike' ? 'You dont like this post' : 'Dislike';
            if (isLike) {
                event.target.nextElementSibling.innerText = 'Dislike';
            } else {
                event.target.previousElementSibling.innerText = 'Like';
            }
        });
});

  console.log( "ready!" );
});
</script>