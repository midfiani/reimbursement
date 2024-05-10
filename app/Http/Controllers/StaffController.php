<?php

namespace App\Http\Controllers;

use App\Models\Reimburse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    public function index(){
        $user = Auth::user();
        $data_reimburse = Reimburse::where('nip', $user->nip)->paginate(20);

        return view('reimburse.reimburse_list',compact('data_reimburse', 'user'))
        ->with('i',(request()->input('page',1)-1)*20);
    }

     /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        // 
    }

     /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      //
    }

}
