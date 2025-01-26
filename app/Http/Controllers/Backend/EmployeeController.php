<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\StageUser;
use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Product;
use App\Models\StageGroup;
use App\Models\StageProduct;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Star\DataTables\Facades\DataTables;
use Star\Flash\Flash;

class EmployeeController extends Controller
{
    public $module_title;

    public $module_name;

    public $module_path;

    public $module_icon;

    public $module_model;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Nhân viên';

        // module name
        $this->module_name = 'employees';

        // directory path of the module
        $this->module_path = 'employees';

        // module icon
        $this->module_icon = 'fa-solid fa-user-shield';

        // module model name, path
        $this->module_model = "App\Models\User";
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_action = 'List';
        $module_name_singular = Str::singular($module_name);
        $page_heading = ucfirst($module_title);
        $title = $page_heading.' '.ucfirst($module_action);
        
        $$module_name = $module_model::paginate();

        Log::info(label_case($module_title.' '.$module_action).' | User:'.auth()->user()->name.'(ID:'.auth()->user()->id.')');

        return view(
            "backend.{$module_path}.index",
            compact('module_title', 'module_name', "{$module_name}", 'module_icon', 'module_name_singular', 'module_action', 'page_heading', 'title')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Create';

        $permissions = Permission::select('name', 'id')->get();

        Log::info(label_case($module_title.' '.$module_action).' | User:'.auth()->user()->name.'(ID:'.auth()->user()->id.')');

        return view("backend.{$module_name}.create", compact('module_title', 'module_name', 'module_icon', 'module_action', 'permissions'));
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
    public function show(StageUser $stageUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StageUser $stageUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StageUser $stageUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StageUser $stageUser)
    {
        //
    }


    public function assignStages(User $employee) {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $$module_name_singular = $employee;
        $module_action = 'Create';
        $products = Product::all();
        $product_stages = StageProduct::all();

        $permissions = Permission::select('name', 'id')->get();

        Log::info(label_case($module_title.' '.$module_action).' | User:'.auth()->user()->name.'(ID:'.auth()->user()->id.')');

        return view("backend.{$module_name}.assign_stages", compact('product_stages', 'products', 'module_title', 'module_name', 'module_icon', 'module_action', 'permissions', 'module_name_singular', "{$module_name_singular}"));
    }


    public function assign(User $employee, Request $request) {
        $stage_user = StageUser::create([
            'product_id' => $request->product_id,
            'stage_id' => $request->stage_id,
            'user_id' => $employee->id ?? null,
            'group_stage_id' => $request->stage_group_id ?? null,
            'total' => 0
        ]);
        

        $module_name = $this->module_name;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Assign stages';

        $$module_name_singular = $employee;

        return redirect("admin/{$module_name}");
    }
}
