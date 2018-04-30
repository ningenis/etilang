<?php

namespace App\Http\Controllers;

use Auth; 
use App\Violation;
use Illuminate\Http\Request;
use App\Http\Requests\ViolationStore;
use App\Events\ViolationCreated;
use App\Services\ViolationService;

class ViolationController extends Controller
{
    private $service;

    public function __construct(ViolationService $service)
    {
        $this->service = $service;
    }

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
        //$stations = new StationController();
        //$stations = $stations->index($request);
        //$items = Auth::user()->violations()->latest('updated_at')->paginate(10);
        return view('violations.index', ['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('violations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ViolationStore $request)
    {
        //$violation = new Violation();
        //$violation->fill($request->all());
        //$violation->violator_identity_number = $request->violator_identity_number;
        //$violation->violator_name = $request->violator_name;
        //$violation->status = "NEW";
        //$violation->station_id = $request->station_id;

        //$violation->officer_id = $request->user()->id;

        //$user = $request->user();
        //$violation->user()->associate($user);
        //$violation->station()->associate($request->station_id);
        //$user->violations()->save($violation);
        //event(new ViolationCreated($violation));
        //$violation->save();
        $this->service->create($request->all());
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
        $stations = new StationController();
        $stations = $stations->index($request);
        if($request->user()->can('edit-violation', $violation)) {
            return view('violations.edit', ['violation' => $violation, 'stations' => $stations]);    
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
    public function update(Violation $violation, Request $request)
    {
        //$violation->fill($request->all());
        //$violation->violator_identity_number = $request->get('violator_identity_number');
        //$violation->violator_name = $request->get('violator_name');
        //$violation->station_id = $request->get('station_id');
        $this->service->update($violation, $request->all());
        //$violation->save();
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
