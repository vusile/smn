<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Events\CommentPosted;
use App\Song;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        if (
                $request->input('song_id') 
                && !$request->input('maoni')
        ) {            
            $this->validate($request, [
                'name' => 'required',
                'comment' => 'required',
                'song_id' => 'required',
            ]);

            $comment = Comment::create($request->all());
            
            event(new CommentPosted($comment));

            $song = Song::find($request->input('song_id'));

            return redirect('/song/' . $song->url . '/' . $song->id . '#' . $comment->id);
        }
        
        return back();
    }
}
