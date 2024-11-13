<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\User;
use App\Models\Tag;
use App\Models\TopicCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
    /**
     * Показать страницу просмотра выбранного топика.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showTopic($id)
    {
        $topic = Topic::findOrFail($id);
        return view('admin.topics.show', compact('topic'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Получить все топики
        $topics = Topic::all();
        return view('admin.topics.index', compact('topics'));
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
        return view('admin.topics.create', compact('tags', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Валидация данных
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:topic_categories,id',
            'img' => 'nullable|image|max:2048',
        ]);
    
        // Загрузка изображения, если оно было загружено
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $request->file('image')->storeAs('uploads', $imageName, 'public');
        }
    
        $topic = new Topic();
        $topic->title = $request->title;
        $topic->content = $request->content;
        $topic->category_id = $request->category_id;
        $topic->user_id = Auth::id(); 
        $topic->img = $imagePath;
        $topic->save();
    
        if ($request->has('tags')) {
            $topic->tags()->attach($request->tags);
        }
    
        return redirect()->route('admin.topics.index')->with('success', 'Topic created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function edit(Topic $topic)
    {
        $tags = Tag::all();
        $categories = TopicCategory::all();
        return view('admin.topics.edit', compact('tags', 'categories'), compact('topic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Topic $topic)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:topic_categories,id',
            'img' => 'nullable|image|max:2048',
        ]);
    
        $topic->title = $request->title;
        $topic->content = $request->content;
        $topic->category_id = $request->category_id;
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $request->file('image')->storeAs('uploads', $imageName, 'public');
            $topic->img = $imagePath;
        }
    
        if ($request->has('tags')) {
            $topic->tags()->sync($request->tags); 
        } else {
            $topic->tags()->detach(); 
        }
    
        $topic->save();
    
        return redirect()->route('admin.topics.index')->with('success', 'Topic updated successfully');
    }    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topic $topic)
    {
        DB::table('topic_tag')->where('topic_id', $topic->id)->delete();
        $topic->delete();
        return redirect()->route('admin.topics.index')->with('success', 'Topic deleted successfully');
    }
}
