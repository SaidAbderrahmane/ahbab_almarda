<?php

namespace App\Http\Controllers;

use App\Models\OperationDon;
use Illuminate\Http\Request;

class OperationDonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $compaigns = OperationDon::all()->toQuery()->orderBy("num_operation")->paginate(30);
        return view('pages.compaigns.compaigns',['compaigns' => $compaigns]);
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

    /**
     * Display the specified resource.
     */
    public function show($id)
    {   
        $compaign = OperationDon::all()->firstWhere("key_operation","=",$id);
        $compaign_detail = $compaign->detailOperation->toQuery()->paginate(50);
        $response =['compaign' => $compaign,'compaign_detail'=>$compaign_detail];
        return view('pages.compaign-detail.compaign-detail',$response);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OperationDon $operationDon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OperationDon $operationDon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OperationDon $operationDon)
    {
        //
    }
}
