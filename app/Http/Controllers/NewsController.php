<?php

namespace App\Http\Controllers;

use App\News;
use App\Like;
use App\User;
use Illuminate\Http\Request;
use Auth;
use DB;
class NewsController extends Controller
{
    // public function __construct()
    // {
    //     // $this->middleware('auth');
    // } 
    public function index()
    {
       //dd(Auth::id());
        $news = news::where('status',1)->get();
//dd($news->toArray());
// Auth::user()->likes()->where('news_id', $value->id)->first();
  $news = news::where('status',1)->get();
        return view('news.index',compact('news',$news));
    }
    public function create()
    {
        return view('news.create');
    }
    
    public function store(Request $request)
    {
         $request->validate([
            'title' => 'required|min:3',
            'details' => 'required',
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048' 
        ]);   
  
        if($request->has('image'))
        {
            $imageName = time().'.'.request()->image->getClientOriginalExtension();
             request()->image->move(public_path('image'), $imageName);
        }else{
              $imageName =  'default.png'; 
            //dd($imageName);
        } 
        // dd(Auth::id());
         $news = News::create(['user_id' => Auth::id(),'title' => $request->title,'details' => $request->details,'image' =>$imageName, 'status' =>1]);
        return redirect()->route('News.index')->with('success','News deleted successfully');
     }
   
    public function edit($id)
    {
        $news = News::find($id);  
        if(Auth::id() !== $news->user_id) 
        {
            return redirect()->route('News.index')->withErrors('You Have Not Permission Update This News');
        }else{
            return view('news.edit')->with('news', $news);
        }
        return view('news.edit',compact('news',$news));
    }

    public function update(Request $request, $id)
    {
       $news = News::find($id);       
           $data = $this->validate($request, [
            'title'=> 'required',
            'details'=>'required' 
        ]);

        if($request->has('image'))
        {   //dd($request);
            $imageName = time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('image'), $imageName);
        }
        else{
            $imageName = $news->image;  
        }  

      $form_data = array(
            'title'       =>   $request->title,
            'details'     =>   $request->details, 
            'status' =>1,
            'image' =>$imageName
         );
           News::whereId($id)->update($form_data);
            return redirect()->route('News.index')->with('success','News updated successfully');
    }
 
    public function destroy($id)
    {
        $news = News::find($id);
             $news->delete();
            return redirect()->route('News.index')->with('success','News deleted successfully');

     }

     public function newsLike(Request $request)
     {
      // dd($request->toArray());
     $news_id = $request['news_id'];
     $is_like = $request['isLike'] === 'true';
           $update = false;
           $news = News::find($news_id);
           // dd($news);
           if (!$news) {
                return null;
           }
           $user = Auth::User();
           $like = $user->likes()->where('news_id', $news_id)->first();
           if ($like) {
              // dd($like);
               $already_like = $like->like;
               $update = true;
               if ($already_like == $is_like) {
                   $like->delete();
                   return null;
               }
            }else{
                $like = new Like();
                }
           $like->like = $is_like;
           $like->user_id = $user->id;
           $like->news_id = $news->id;
    //       dd($like->toArray());
           if ($update) {
               $like->update();
           } else {
               $like->save();
           }
           return null;
       
     }
}
