<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Frontend\manager;
use App\Models\Frontend\sarana;
use App\Models\Frontend\ProfilAnak;

class AboutController extends Controller
{
    public function index()
    {
      $data = array();
      $data['managers'] = manager::all();
      $data['orphanages'] = ProfilAnak::all();
      $data['sarana']= sarana::all();
      // $data['kamar']= sarana::where

      return view('frontend.pages.about', compact('data'));
    }

}
