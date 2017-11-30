<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\Desenvolvedor;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $dev = count( Desenvolvedor :: where( 'user_id', '=',  Auth::id() )->first() ) != 0 ? false : true;
        return view('home', [ 'exibirModal' => $dev, 'dev' => false ] );
    }
}
