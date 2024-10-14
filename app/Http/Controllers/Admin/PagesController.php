<?php

namespace App\Http\Controllers\Admin;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class PagesController extends Controller
{
    public function index()
    {
        $blogPosts = BlogPost::all()
         ->sortByDesc('id');

        return view(
            'pages.admin.index',
            compact(
                'blogPosts'
            )
        );
    }

    public function edit(BlogPost $blogPost)
    {
        return view(
            'pages.admin.edit',
            compact(
                'blogPost'
            )
        );
    }

    public function update(BlogPost $blogPost, Request $request)
    {
        $this->validate(
            $request,
            [
                'title' => 'required',
                'text' => 'required'
            ],
            [
                'title.required' => 'Kichwa cha Habari ni lazima',
                'text.required' => 'Maelezo, walau mafupi, ni lazima',
            ]
        );

        $url = Str::slug($request->title);

        $additionalInfo = ['url' => $url];

        if($request->file('document')) {
            $documentName = $url . "." .  last(explode('.', $request->document->getClientOriginalName()));
            $request->file('document')->storeAs('documents', $documentName);
            $additionalInfo['document'] = $documentName;
        }

        $blogPost->update(
            array_merge(
                $request->except(['_token']),
                $additionalInfo
            )
        );

        return redirect('/admin/pages' )
            ->with('message', 'Taarifa umeboreshwa!');
    }

    public function create()
    {
        return view(
            'pages.admin.create'
        );
    }

    public function save( Request $request)
    {
        $this->validate(
            $request,
            [
                'title' => 'required',
                'text' => 'required'
            ],
            [
                'title.required' => 'Kichwa cha Habari ni lazima',
                'text.required' => 'Maelezo, walau mafupi, ni lazima',
            ]
        );

        $url = Str::slug($request->title);

        $additionalInfo = [
            'url' => $url,
            'date_added' => date('Y-m-d')
        ];

        if($request->file('document')) {
            $documentName = $url . "." .  last(explode('.', $request->document->getClientOriginalName()));
            $request->file('document')->storeAs('documents', $documentName);
            $additionalInfo['document'] = $documentName;
        }

         $blogPost = new BlogPost(
            array_merge(
                $request->except(['_token']),
                $additionalInfo
            )
        );

        $blogPost->save();

        return redirect('/admin/pages' )
            ->with('message', 'Ukurasa mpya umetengenezwa!');
    }
}
