<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{

    public function index()
    {
        $categories = Category::all()
            ->sortBy('title');

        return view(
            'categories.admin.index',
            compact(
                'categories'
            )
        );
    }

    public function edit(Category $category)
    {
        return view(
            'categories.admin.edit',
            compact(
                'category'
            )
        );
    }

    public function update(Category $category, Request $request)
    {
        $this->validate(
            $request,
            [
                'title' => 'required',
            ],
            [
                'title.required' => 'Jina la Category ni lazima',
            ]
        );

        $url = Str::slug($request->title);

        $additionalInfo = ['url' => $url];

        if($request->file('image')) {
            $imageName = $url . "." .  last(explode('.', $request->image->getClientOriginalName()));
            $request->file('image')->storeAs('public/images', $imageName);
            $additionalInfo['image'] = $imageName;
        }

        $category->update(
            array_merge(
                $request->except(['category_id', '_token']),
                $additionalInfo
            )
        );

        return redirect('/admin/categories' )
            ->with('message', 'Category imeboreshwa!');
    }

    public function create()
    {
        return view(
            'categories.admin.create'
        );
    }

    public function save( Request $request)
    {
        $this->validate(
            $request,
            [
                'title' => 'required',
                'image' => 'required'
            ],
            [
                'title.required' => 'Jina la Category ni lazima',
                'image.required' => 'Picha lazima',
            ]
        );

        $url = Str::slug($request->title);

        $additionalInfo = ['url' => $url];

        if($request->file('image')) {
            $imageName = $url . "." .  last(explode('.', $request->image->getClientOriginalName()));
            $request->file('image')->storeAs('public/images', $imageName);
            $additionalInfo['image'] = $imageName;
        }

         $category = new Category(
            array_merge(
                $request->except(['category_id', '_token']),
                $additionalInfo
            )
        );

        $category->save();

        return redirect('/admin/categories' )
            ->with('message', 'Category mpya imegengenezwa!');
    }
}
