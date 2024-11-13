<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\TopicCategory;

class SearchController extends Controller
{
    public function searchTopicsForm()
    {
        return view('client.search.topics');
    }

    public function searchCategoriesForm()
    {
        return view('client.search.categories');
    }

    public function searchTopics(Request $request)
    {
        $search = $request->input('search');

        $topics = Topic::where('title', 'LIKE', "%$search%")->get();

        return view('client.search.topics_result', compact('topics'));
    }

    public function searchCategories(Request $request)
    {
        $search = $request->input('search');

        $categories = TopicCategory::where('name', 'LIKE', "%$search%")->get();

        return view('client.search.categories_result', compact('categories'));
    }
}
