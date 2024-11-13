<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\TopicCategory;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = TopicCategory::all();
        $query = Topic::query();

        if ($request->has('category')) {
            $category_id = $request->input('category');
            if ($category_id != "") {
                $query->where('category_id', $category_id);
            }
        }
    
        $topics = $query->paginate(2); 
    
        return view('client.topics.index', compact('topics', 'categories'));
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
        return view('client.topics.show', compact('topic'));
    }

    public function toggleFavorite($id)
    {
        $user = Auth::user();
        $topic = Topic::findOrFail($id);

        if ($user->favorites()->where('topic_id', $id)->exists()) {
            $user->favorites()->detach($id);
        } else {
            $user->favorites()->attach($id);
        }

        return redirect()->back();
    }

    public function favorites()
    {
        $user = Auth::user();
        $favorites = $user->favorites;

        return view('client.topics.favorites', compact('favorites'));
    }
}
