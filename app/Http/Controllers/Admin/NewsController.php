<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\News;
class NewsController extends Controller
{ 
	public function index()
    {
    	// dd("sas");
    	   $news = news::all();
   		   return view('admin.news.index',compact('news',$news));
     }
     public function changestatus(Request $request)
     {
	     $news = News::find($request->id); 
        // dd($news->status);
	     if($news->status==0)
	     {  $news->status = 1;
	     	// dd($news->status);
         $news->save();
	     }else
	     {
	     	$news->status = 0;
 	 	     $news->save();

	     }
            return redirect()->back()->with('success', 'Status Update Successfully');	
      
     }

 
}
