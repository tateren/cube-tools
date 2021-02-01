<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class CommutatorController extends Controller
{
    public function __invoke(): Renderable
    {
        return view('commutator.index');
    }
}
