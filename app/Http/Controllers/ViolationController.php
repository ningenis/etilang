<?php

namespace App\Http\Controllers;

use Auth; 
use App\Violation;
use Illuminate\Http\Request;

class ViolationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$items = Violation::latest('updated_at')->paginate(10);
        //$items = Violation::where('officer_id', Auth::id())->paginate(10);
        $items = $request->user()->violations()->latest('updated_at')->paginate(10);
        //$items = Auth::user()->violations()->latest('updated_at')->paginate(10);
        return view('violations.index', ['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('violations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $violation = new Violation();
        $request->validate([
            'violator_identity_number' => 'required',
            'violator_name' => 'required',
        ]);
        $violation->violator_identity_number = $request->violator_identity_number;
        $violation->violator_name = $request->violator_name;
        $violation->status = "NEW";

        //$violation->officer_id = $request->user()->id;

        $user = $request->user();
        $violation->user()->associate($user);
        $user->violations()->save($violation);

        //$violation->save();
        return redirect()->route('violations.index')->with('message', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Violation $violation)
    {
        if($request->user()->can('edit-violation', $violation)) {
            return view('violations.edit', ['violation' => $violation]);    
        } else {
            abort(404);  
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Violation $violation)
    {
        $violation->violator_identity_number = $request->get('violator_identity_number');
        $violation->violator_name = $request->get('violator_name');
        $violation->save();
        return redirect()->route('violations.index')->with('message', 'Data berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Violation $violation)
    {
        $violation->delete();
        return redirect()->route('violations.index')->with('message', 'Data berhasil dihapus');
    }
}
