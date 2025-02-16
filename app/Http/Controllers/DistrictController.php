<?php

namespace App\Http\Controllers;

use App\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        $this->validate($request,[
            'district_name'=> ['required', 'max:30', 'unique:districts'],
            'fee'=>'required',
        ]);

        if(preg_match("/^[0-9,]+$/", $request->input('fee'))){ 
            $fee = str_replace(',','',$request->input('fee'));
        }
        
        $district = new District;
        $district->district_name = $request->input('district_name');
        $district->delivery_fee = $fee;
        $district->save();

        return redirect('/admini/edit');

    }

    public function add_location(Request $request, $id){
        $this->validate($request,[
            'district_name'=> ['required', 'max:30', 'unique:districts'],
            'fee'=>'required',
        ]);

        if(preg_match("/^[0-9,]+$/", $request->input('fee'))){ 
            $fee = str_replace(',','',$request->input('fee'));
        }
        $district = District::find($id);
        $location = new District;
        $location->parent_id =  $district->id;
        $location->district_name = $request->input('district_name');
        $location->delivery_fee = $fee;
        $location->save();

        return redirect('/admini/single_district/'.$id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\District  $district
     * @return \Illuminate\Http\Response
     */
    public function show(District $district)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\District  $district
     * @return \Illuminate\Http\Response
     */
    public function edit(District $district)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\District  $district
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, District $district)
    {
        $this->validate($request,[
            'district_name'=> ['required', 'max:30'],
            'fee'=>'required',
        ]);

        if(preg_match("/^[0-9,]+$/", $request->input('fee'))){ 
            $fee = str_replace(',','',$request->input('fee'));
        }
        
        $district->district_name = $request->input('district_name');
        $district->delivery_fee = $fee;
        $district->save();

        if($district->parent_id == null){
            return redirect('/admini/edit');
        }
        else{
            return redirect('/admini/single_district/'.$district->parent_id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\District  $district
     * @return \Illuminate\Http\Response
     */
    public function destroy(District $district)
    {
        $district->delete();

        return redirect('/admini/edit');
    }

    public function get_sub_locations($id){
        $output = "";    
        $district = District::find($id);
        $sublocations = $district->sub_locations->pluck("district_name","id");
        
        return json_encode($sublocations);
    }

    public function get_sub_locations1($id){
        $output = "";    
        $district = District::find($id);
        $sublocations = $district->sub_locations->pluck("district_name","id");
        
        return json_encode($sublocations);
    }
}
