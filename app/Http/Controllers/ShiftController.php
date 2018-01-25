<?php

namespace App\Http\Controllers;

use App\Shift;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Input;
use App\Http\Requests\JobCreateRequest;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Shift::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobCreateRequest $request)
    {
        $shift = new Shift();
        $shift->job_title = request()->input('title');
        $shift->role = request()->input('role');
        $shift->practice_id = request()->input('practice');
        $shift->description = request()->input('description');
        $shift->start_time = request()->input('startTime');
        $shift->end_time = request()->input('endTime');
        $shift->price = request()->input('price');
        $shift->is_permanent = request()->input('isPermanent');

        $shift->save();
        return $shift;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Shift::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function edit(Shift $shift)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function update(JobCreateRequest $request, $id)
    {
        $shift = Shift::findOrFail($id);
        if(! $shift) {
            return response()->json(['message' => 'Shift not found'], 404);
        }

        $shift = new Shift();
        $shift->job_title = request()->input('title');
        $shift->role = request()->input('role');
        $shift->practice_id = request()->input('practice');
        $shift->description = request()->input('description');
        $shift->start_time = request()->input('startTime');
        $shift->end_time = request()->input('endTime');
        $shift->price = request()->input('price');
        $shift->is_permanent = request()->input('isPermanent');

        $shift->save();
        return $shift;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shift = Shift::find($id);
        $shift->delete();
        return response()->json(['message' => 'Shift deleted'], 200);
    }
}
