<?php

namespace App\Http\Controllers;

use App\Models\Reimburse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReimburseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

    }

     /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('reimburse.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $user = Auth::user();
            // fungsi dibawah digunakan untuk mengambil nama file
            $time = strtotime(date("Y-m-d H:i:s"));
            $getFilename =  $request->filename->getClientOriginalName();
            $imageName =  $user->nip."_".$time."_".$getFilename;
            // fungsi move untuk mengupload file ke lokal folder public
            $request->filename->move(public_path('images'),$imageName);
            Reimburse::create([
                'nip'=>$user->nip,
                'reimburse_name'=>$request->title,
                'amount'=>$request->nominal,
                'file_name'=>$imageName,
                'description'=>$request->deskripsi,
                'status'=>1, //default pending
            ]);
            // redirect ke halaman list reimburse
            return redirect()->route($user->level.'.index')->with('success','Successfully to create new data');
        } catch (\Throwable $th) {
            //throw $th;
           // munculkan pesan error jika ada error
            return redirect()->route($user->level.'.index')->with('error',$th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
