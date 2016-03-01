<?php

namespace NineCells\Til\Http\Controllers;

use NineCells\Til\Models\TilPost;

class MemberController extends Controller
{
    public function GET_member_til_info($member_id)
    {
        $posts = TilPost::orderBy('id', 'desc')
            ->paginate(10);

        return view('ncells::til.pages.member_til', [
            'member_id' => $member_id,
            'posts' => $posts,
        ]);
    }
}
