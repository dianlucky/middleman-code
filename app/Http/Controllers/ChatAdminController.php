<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class ChatAdminController extends Controller
{
    /**
     * @param Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request): View
    {
        $title = 'Room Page | MiddleMan';

        return view('admin.room.index')->with(compact('title'));
    }
}
