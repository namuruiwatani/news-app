<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Topic;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        return Tag::all();
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|unique:tags']);
        $tag = Tag::create(['name' => $request->name]);
        return response()->json($tag, 201);
    }

    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();
        return response()->json(null, 204);
    }

    public function attachTagToTopic(Request $request, $topicId)
    {
        $topic = Topic::findOrFail($topicId);
        $request->validate(['tags' => 'required|array']);
        $tagIds = $request->tags;
        $topic->tags()->attach($tagIds);
        return response()->json($topic->tags);
    }

    public function detachTagFromTopic($topicId, $tagId)
    {
        $topic = Topic::findOrFail($topicId);
        $topic->tags()->detach($tagId);
        return response()->json($topic->tags);
    }
}
