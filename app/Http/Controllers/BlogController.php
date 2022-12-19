<?php

namespace App\Http\Controllers;


use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('blog',[
            'blogs' => Blog::where('id', auth()->user()->id)->get()
        ])
        ->with('i', (request()->input('page',1)-1)*10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('actions.create');
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
            'nama' => 'required',
            'deskripsi' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
  
        $input = $request->all();
  
        if ($foto = $request->file('foto')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $foto->getClientOriginalExtension();
            $foto->move($destinationPath, $profileImage);
            $input['foto'] = "$profileImage";
        }
    
        Blog::create($input);
     
        return redirect()->route('blog.index')
                        ->with('success','Product created successfully.');
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
    public function edit(Blog $blog)
    {
        return view('actions.edit',compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required'
        ]);
  
        $input = $request->all();
  
        if ($foto = $request->file('foto')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $foto->getClientOriginalExtension();
            $foto->move($destinationPath, $profileImage);
            $input['foto'] = "$profileImage";
        }else{
            unset($input['foto']);
        }
          
        $blog->update($input);
    
        return redirect()->route('blog.index')
                        ->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
     
        return redirect()->route('blog.index')
                        ->with('success','Product deleted successfully');
    }
}
