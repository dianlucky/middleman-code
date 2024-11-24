<?php

namespace App\Http\Controllers;

class HomepageController extends Controller
{
    public function homepage()
    {
        return view('userview.index', [
            'title' => 'Homepage | MiddleMan',
        ]);
    }

    public function about()
    {
        return view('userview.about', [
            'title' => 'About | MiddleMan',
        ]);
    }

    public function price()
    {
        return view('userview.price', [
            'title' => 'Pricing List | MiddleMan',
        ]);
    }

    public function testimonial()
    {
        return view('userview.testimonial', [
            'title' => 'Testimonial | MiddleMan',
        ]);
    }

    public function contact()
    {
        return view('userview.contact', [
            'title' => 'Contact | MiddleMan',
        ]);
    }
}
