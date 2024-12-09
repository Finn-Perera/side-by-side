<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Topic;
use App\Models\User;


class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $topics = Topic::all();

        return view('topics.index', ['topics' => $topics]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('topics.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $yearsAhead = 1000;
        $maxYear = now()->addYears($yearsAhead)->format('Y');

        $verified_data = $request->validate([
            'title' => 'required|max:255',
            'date' => "nullable|date|before_or_equal:$maxYear",
            'content' => 'required|string',
        ], [
           'date.before_or_equal' => "The topic date must be before $yearsAhead years from current date.",
        ]);

        $t = new Topic;
        $t->title = $verified_data['title'];
        $t->date = $verified_data['date'];
        $t->content = $verified_data['content'];
        $t->author_id = Auth::user()->id;
        $t->save();
        
        return redirect()->route('topics.index')->with('message', 'Topic was created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Topic $topic)
    {
        return view('topics.show', ['topic' => $topic]);
    }

    public function showUserTopics(User $user) {
        return view('users.topics', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Topic $topic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Topic $topic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Topic $topic)
    {
        //
    }
}
