<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Category;
use DB;

class CategoryController extends Controller
{
    public function index()
    {
   // DB::enableQueryLog();
       $categories = Category::with('children')->whereNull('parent_id')->get();
   // dd(DB::getQueryLog());
  // dd($categories->toArray());
      return view('categories.index')->with([
        'categories'  => $categories
      ]);
    }
     
    public function create()
    {
        //
    }
    
    public function store(Request $request)
    {
          $validatedData = $this->validate($request, [
                'name'      => 'required|min:3|max:255|string',
                'parent_id' => 'sometimes|nullable|numeric'
          ]);

          Category::create($validatedData);

          return redirect()->route('category.index')->withSuccess('You have successfully created a Category!');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
 public function update(Request $request, Category $category)
{
        $validatedData = $this->validate($request, [
            'name'  => 'required|min:3|max:255|string'
        ]);

        $category->update($validatedData);

        return redirect()->route('category.index')->withSuccess('You have successfully updated a Category!');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $c_id = Category::where('id',$id)->first();
        $c_id->delete();
        return redirect()->route('category.index')->with('success1','Your  Category Deleted successfully!!');
    }
}
