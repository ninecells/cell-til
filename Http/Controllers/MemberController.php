<?php

namespace NineCells\Til\Http\Controllers;

class MemberController extends Controller
{
    public function GET_member_til_info($member_id)
    {
        return view('ncells::til.pages.member_til', [
            'member_id' => $member_id,
        ]);
    }
}
