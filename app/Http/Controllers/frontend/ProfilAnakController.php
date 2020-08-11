<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Frontend\ProfilAnak;
use Illuminate\Http\Request;

class ProfilAnakController extends Controller
{
  protected $data_anak;

  public function __construct(ProfilAnak $data_anak)
  {
    $this->data_anak = $data_anak;
  }
  //
  public function index(Request $request)
  {
    $data['data_anak'] = ProfilAnak::paginate(8);

    if ($request->ajax()) {
      return view('frontend.pages.pagination', $data)->render();
    }

    return view('frontend.pages.profil_anak', $data);
  }

  function fetch_data(Request $request)
  {
  }
}
