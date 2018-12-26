<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Events\CommentPosted;
use App\Models\Song;
use App\Rules\ValidRecaptcha;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        if (
                $request->input('song_id') 
                && !$request->input('maoni')
        ) {    
            $customMessages = [
                'g-recaptcha-response.required' => 'Tafadhali jaribu tena!'
            ];
            
            $this->validate(
                    $request,
                    [
                        'name' => 'required',
                        'comment' => 'required',
                        'song_id' => 'required',
                        'g-recaptcha-response' => ['required', new ValidRecaptcha]
                    ], 
                    $customMessages
                );

            $data = $request->all();
            $comment = Comment::create($data);
            
            event(new CommentPosted($comment, $data));

            $song = Song::find($request->input('song_id'));

            return redirect('/song/' . $song->url . '/' . $song->id . '#' . $comment->id);
        }
        
        return back();
    }
    
    public function show(Comment $comment)
    {
        echo($comment->comment);
    }
}
