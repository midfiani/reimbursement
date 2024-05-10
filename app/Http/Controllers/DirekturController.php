<?php

namespace App\Http\Controllers;

use App\Models\Reimburse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DirekturController extends Controller
{
    public function index(){
        $user = Auth::user();
        $data_reimburse = Reimburse::whereIn('status', [1,2,3])->paginate(20);

        return view('reimburse.reimburse_list',compact('data_reimburse', 'user'))
        ->with('i',(request()->input('page',1)-1)*20);
     }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        Reimburse::where('id',$id)->update([
            'status'=> $request->status
        ]);

        return redirect()->route('DIREKTUR.index')->with('success','Successfully update status with id '.$id);

    }
}
