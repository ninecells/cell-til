<?php

namespace NineCells\Til\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use NineCells\Til\Models\TilPost;
use NineCells\Til\Models\TilCategory;

class TilPostController extends Controller
{
    public function GET_index()
    {
        return view('ncells::til.pages.index');
    }

    public function GET_write_til()
    {
        $this->authorize('til-write');
        return view('ncells::til.pages.write');
    }

    public function POST_write_til(Request $request)
    {
        $this->authorize('til-write');

        $writer_id = Auth::user()->id;

        $cate_title = $request->input('category');
        $cate_title = trim($cate_title);
        $category = TilCategory::where('title', $cate_title)->first();
        if (!$category) {
            $category = TilCategory::create(['title' => $cate_title, 'writer_id' => $writer_id]);
        }

        $request->merge(['category_id' => $category->id, 'writer_id' => $writer_id]);
        TilPost::create($request->all());
        return redirect("members/{$writer_id}/til");
    }

    public function GET_edit_til($til_id)
    {
        $post = TilPost::find($til_id);
        $this->authorize('til-edit', $post);
        return view('ncells::til.pages.edit', ['post' => $post]);
    }

    public function PUT_update_til(Request $request, $til_id)
    {
        $post = TilPost::find($til_id);
        $this->authorize('til-edit', $post);

        $writer_id = Auth::user()->id;

        $cate_title = $request->input('category');
        $cate_title = trim($cate_title);
        $category = TilCategory::where('title', $cate_title)->first();
        if (!$category) {
            $category = TilCategory::create(['title' => $cate_title, 'writer_id' => $writer_id]);
        }

        $input = $request->only(['title', 'content']);
        $input['category_id'] = $category->id;
        TilPost::find($til_id)->update($input);
        return redirect("members/{$writer_id}/til");
    }

    public function delete_til($til_id)
    {
        $post = TilPost::find($til_id);
        $this->authorize('til-edit', $post);
        $post->delete();
        $writer_id = Auth::user()->id;
        return redirect("members/{$writer_id}/til");
    }
}
