<?php

namespace NineCells\Til\Http\Controllers;

class TilPostController extends Controller
{
    public function GET_index()
    {
        return view('ncells::til.pages.index');
    }
}
