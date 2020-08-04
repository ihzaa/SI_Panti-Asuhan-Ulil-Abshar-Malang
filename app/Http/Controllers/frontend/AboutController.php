<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Frontend\about;

class AboutController extends Controller
{
    public function index()
    {
      $data = about::all();

      // dd($data);
      return view('frontend.pages.about', compact('data'));
    }
}
