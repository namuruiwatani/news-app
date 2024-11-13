<?php

namespace App\Http\Controllers\ContentMaker;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use App\Models\TopicCategory;
use App\Models\User;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics = Topic::all();
        return view('content-maker.welcome', compact('topics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $tags = Tag::all();
        $categories = TopicCategory::all();
        return view('content-maker.topics.create', compact('tags', 'categories'));
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
            'title' => 'required',
            'category_id' => 'required',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'content' => 'required',
        ]);

        $imageName = time() . '.' . $request->img->extension();
        $request->img->move(public_path('uploads'), $imageName);

        $topic = new Topic();
        $topic->user_id = Auth::id(); 
        $topic->category_id = $request->category_id;
        $topic->img = 'uploads/' . $imageName;
        $topic->title = $request->title;
        $topic->content = $request->content;
        $topic->save();

        if ($request->has('tags')) {
            $topic->tags()->attach($request->tags);
        }

        return redirect()->route('content-maker.topics.index')->with('success', 'Topic created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $topic = Topic::findOrFail($id);
        return view('content-maker.topics.show', compact('topic'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tags = Tag::all();
        $topic = Topic::findOrFail($id);
        $categories = TopicCategory::all();
        return view('content-maker.topics.edit', compact('tags', 'categories'), compact('topic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'content' => 'required',
            'img' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        $topic = Topic::findOrFail($id);

        $topic->category_id = $request->category_id;
        $topic->title = $request->title;
        $topic->content = $request->content;

        if ($request->hasFile('img')) {
            Storage::delete($topic->img);

            $imagePath = $request->file('img')->store('uploads', 'public');

            $topic->img = $imagePath;
        }

        if ($request->has('tags')) {
            $topic->tags()->sync($request->tags); 
        } else {
            $topic->tags()->detach(); 
        }

        $topic->save();

        return redirect()->route('content-maker.topics.index')->with('success', 'Topic updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $topic = Topic::findOrFail($id);
        $topic->delete();

        return redirect()->route('content-maker.topics.index')->with('success', 'Topic deleted successfully!');
    }
}
