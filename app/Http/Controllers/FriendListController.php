<?php

namespace App\Http\Controllers;

use App\Models\FriendList;
use App\Http\Requests\StoreFriendListRequest;
use App\Http\Requests\UpdateFriendListRequest;

class FriendListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFriendListRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(FriendList $friendList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FriendList $friendList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFriendListRequest $request, FriendList $friendList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FriendList $friendList)
    {
        //
    }
}
