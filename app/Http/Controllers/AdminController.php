<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Collection;
class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = Collection::where(['hierarchy' => 'background'])->paginate(4);
        return view('dashboard',['collections'=>$collection]);
    }
}