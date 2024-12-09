<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // might want to check parent exists and commentable exists
        $request->validate([
            'content' => 'required|string|max:1000', // Could change value here
            'parent_id' => 'nullable|numeric|exists:comments,id',
            'commentable_type' => 'required|string',
            'commentable_id' => 'required|integer',
        ]);

        $commentableClass = $request->input('commentable_type');
        $commentableId = $request->input('commentable_id');
        if(!class_exists($commentableClass)) {
            abort(404, 'Invalid commentable type');
        }
    
        $comment = new Comment;
        $comment->content = $request['content'];
        $comment->commentable_type = $commentableClass;
        $comment->commentable_id = $commentableId;
        $comment->parent_id = $request->parent_id ?? null;
        $comment->author_id = Auth::user()->id;
        $comment->save();

        return back()->with('message', 'Comment added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show users comments.
     */
    public function showUserComments(User $user) {
        $comments = $user->comments()->with('commentable')->get();
        return view('users.comments', ['user' => $user, 'comments' => $comments]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
