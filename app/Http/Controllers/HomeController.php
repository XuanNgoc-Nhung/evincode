<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $list_product = Posts::paginate(4);
        return view('user.index',compact('list_product'));
    }
    public function detailProduct(Request $request){
        $req = $request->all();
        $product_detail = Posts::where('id',$req['id'])->first();
        if($product_detail){
            return view('user.product-detail',compact(['product_detail']));
        }else{
            abort(500);
        }
    }
}
