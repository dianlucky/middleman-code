<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    protected $UserModel;

    public function __construct(){
        $this->UserModel = new User();
    }
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

     public function transaction()
    {
        $dataMember = $this->UserModel->where('role', 'member')->get();
        
        return view('userview.transaction', [
            'member' => $dataMember,
            'title' => 'Transaction | MiddleMan',
        ]);
    }
}
