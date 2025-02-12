<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\StageProduct;
use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\StageGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Star\DataTables\Facades\DataTables;
use Star\Flash\Flash;
class StageProductController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
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
    public function show(StageProduct $stageProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StageProduct $stageProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StageProduct $stageProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StageProduct $stageProduct)
    {
        //
    }
}
