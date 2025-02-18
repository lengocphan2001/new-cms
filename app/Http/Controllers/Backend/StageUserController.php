<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\StageUser;
use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\StageGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Star\DataTables\Facades\DataTables;
use Star\Flash\Flash;

class StageUserController extends Controller
{
    public $module_title;

    public $module_name;

    public $module_path;

    public $module_icon;

    public $module_model;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'San luong';

        // module name
        $this->module_name = 'stage_users';

        // directory path of the module
        $this->module_path = 'stage_users';

        // module icon
        $this->module_icon = 'fa-solid fa-user-shield';

        // module model name, path
        $this->module_model = "App\Models\StageUser";
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
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

        if (auth()->user()->hasRole('user'))
        
            $$module_name = $module_model::where('user_id', auth()->user()->id)->paginate(10);
        else 
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

        if (! auth()->user()->can('add_stage_users')) {
            abort(404);
        }
        
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);
        $stage_groups = StageGroup::all();

        $module_action = 'Create';

        $permissions = Permission::select('name', 'id')->get();

        Log::info(label_case($module_title.' '.$module_action).' | User:'.auth()->user()->name.'(ID:'.auth()->user()->id.')');

        return view("backend.{$module_name}.create", compact('module_title', 'module_name', 'module_icon', 'module_action', 'permissions', 'stage_groups'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (! auth()->user()->can('add_stage_users')) {
            abort(404);
        }
        
        $stage_user = StageUser::where('product_id', $request->product_id)->where('user_id', Auth::user()->id)->first();
        // dd($stage_user);
        $stage_user->update([
            'total' => $stage_user->total + intval($request->total)
        ]);

        Flash::success("<i class='fas fa-check'></i> Gửi báo cáo thành công")->important();

        return redirect()->back();
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
        if (! auth()->user()->can('edit_stage_users')) {
            abort(404);
        }

        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Edit';

        $$module_name_singular = $stageUser;


        Log::info(label_case($module_title.' '.$module_action)." | '".$$module_name_singular->name.'(ID:'.$$module_name_singular->id.") ' by User:".auth()->user()->name.'(ID:'.auth()->user()->id.')');

        return view(
            "backend.{$module_name}.edit",
            compact('module_title', 'module_name', 'module_path', 'module_icon', 'module_action', 'module_name_singular', "{$module_name_singular}")
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StageUser $stageUser)
    {
        if (! auth()->user()->can('edit_stage_users')) {
            abort(404);
        }

        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Update';

        $$module_name_singular = $stageUser;

        $stage->update($request->all());

        Flash::success("<i class='fas fa-check'></i> Updated Successfully")->important();

        Log::info(label_case($module_title.' '.$module_action)." | '".$$module_name_singular->name.'(ID:'.$$module_name_singular->id.") ' by User:".auth()->user()->name.'(ID:'.auth()->user()->id.')');

        return redirect("admin/{$module_name}");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StageUser $stageUser)
    {
        if (! auth()->user()->can('delete_stage_users')) {
            abort(404);
        }

        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Update';

        $$module_name_singular = $stageUser;

        $stageUser->delete();

        Flash::success("<i class='fas fa-check'></i> Xóa thành công")->important();

        Log::info(label_case($module_title.' '.$module_action)." | '".$$module_name_singular->name.'(ID:'.$$module_name_singular->id.") ' by User:".auth()->user()->name.'(ID:'.auth()->user()->id.')');

        return redirect("admin/{$module_name}");
    }

}
