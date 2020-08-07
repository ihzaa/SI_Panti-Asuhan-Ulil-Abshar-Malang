<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Frontend\about;
use App\Models\Frontend\manager;
use App\Models\Frontend\orphanage;

class AboutController extends Controller
{
    public function index()
    {
      $data = array();
      $data['about'] = about::all();
      $data['managers'] = manager::all();
      $data['orphanages'] = orphanage::all();

      return view('frontend.pages.about', compact('data'));
    }

}
