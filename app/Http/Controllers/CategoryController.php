<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Auth;

class CategoryController extends Controller
{


    public function index()
    {

        if(Auth::user()->role->name == 'admin'){
           $categories = Category::paginate(3);
       }else if(Auth::user()->role->name == 'seller'){
        $categories = Category::where('created_by', Auth::id())->paginate(3);
    }
    return view(Auth::user()->role->name.'.categories.index', compact('categories'));
}
    /**
     * Display Trashed listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        $categories = Category::onlyTrashed()->paginate(3);
        return view(Auth::user()->role->name.'.categories.index', compact('categories'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->role->name == 'admin'){
            $categories = Category::all();
        }else if(Auth::user()->role->name == 'seller'){
            $categories = Category::where('created_by', Auth::id());
        }
        
        return view(Auth::user()->role->name.'.categories.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|min:5',
            'slug'=>'required|min:5|unique:categories'
        ]);
        $categories = Category::create([
            'title' => $request->title,
            'description' => $request->description,
            'slug' => $request->slug,
            'created_by' => Auth::id()            
        ]);
        $categories->parents()->attach($request->parent_id,['created_at'=>now(), 'updated_at'=>now()]);
        return back()->with('message','Category Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
       $categories = Category::where('id','!=', $category->id)->get();
       return view(Auth::user()->role->name.'.categories.create',['categories' => $categories, 'category'=>$category]);
   }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $category->title = $request->title;
        $category->description = $request->description;
        $category->slug = $request->slug;
        //detach all parent categories
        $category->parents()->detach();
        //attach selected parent categories
        $category->parents()->attach($request->parent_id,['created_at'=>now(), 'updated_at'=>now()]);
        //save current record into database
        $saved = $category->save();
        //return back to the /add/edit form
        if($saved)
            return back()->with('message','Record Successfully Updated!');
        else
            return back()->with('message', 'Error Updating Category');
    }

    public function recoverCat($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        if($category->restore())
            return back()->with('message','Category Successfully Restored!');
        else
            return back()->with('message','Error Restoring Category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if($category->childrens()->detach() && $category->forceDelete()){
            return back()->with('message','Category Successfully Deleted!');
        }else{
            return back()->with('message','Error Deleting Record');
        }
    }
    public function fetchCategories($id = 0){

        if($id == 0)
            return Category::all();

        $category =  Category::where('id', $id)->first();
        return $category->childrens;
    }

        /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
        public function remove(Category $category)
        {
            if($category->delete()){
                return back()->with('message','Category Successfully Trashed!');
            }else{
                return back()->with('message','Error Deleting Record');
            }
        }
    }
