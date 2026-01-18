<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        $title = "UPT PKB Kota Bandar Lampung";

        return view('survei.index', compact('title'));
    }
}