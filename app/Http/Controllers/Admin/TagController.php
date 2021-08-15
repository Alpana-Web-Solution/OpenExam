<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TagCreateRequest;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    //
    public function index()
    {
        $tags = Tag::paginate(10);
        return view('admin.tag.index')->withTags($tags);
    }

    public function create()
    {
        return view('admin.tag.create');
    }

    public function store(TagCreateRequest $request)
    {
        // dd($request->all());
       $test =  Tag::create([
            'name'=>$request->name,
           'slug'=> \Str::slug($request->name),
            'user_id'=>auth()->id()
        ]);
        // dd($test);
        return back()->with('success','Tag is Created');

    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return back()->with('success','Tag is deletd');
    }


}
