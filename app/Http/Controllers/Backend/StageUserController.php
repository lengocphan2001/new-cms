<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\StageUser;
use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Product;
use App\Models\Stage;
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
        $title = $page_heading . ' ' . ucfirst($module_action);

        // Initialize query builder
        $query = $module_model::with(['product', 'stage'])->where('total', '!=', null); // Assuming these relationships are defined

        // Check if the user has a specific role and filter accordingly
        if (auth()->user()->hasRole('user')) {
            $query->where('user_id', auth()->user()->id);
        }

        // Apply search filters
        if ($request->filled('search_name')) {
            $query->where(function($q) use ($request) {
                $q->whereHas('product', function($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->search_name . '%'); 
                })
                ->orWhereHas('stage', function($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->search_name . '%'); 
                });
            });
        }

        if ($request->filled('search_date')) {
            $query->whereDate('created_at', $request->search_date); // Adjust 'created_at' if needed
        }

        // Paginate results
        $module_name = $query->paginate(10);

        Log::info(label_case($module_title . ' ' . $module_action) . ' | User:' . auth()->user()->name . '(ID:' . auth()->user()->id . ')');

        return view(
            "backend.{$module_path}.index",
            compact('module_title', 'module_name', 'module_icon', 'module_name_singular', 'module_action', 'page_heading', 'title')
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

        $module_action = 'Create';
        $stage_users = StageUser::where('user_id', Auth::user()->id)->get();
        $productIds = $stage_users->pluck('product_id');
        $products = Product::whereIn('id', $productIds)->get();
        $permissions = Permission::select('name', 'id')->get();

        Log::info(label_case($module_title.' '.$module_action).' | User:'.auth()->user()->name.'(ID:'.auth()->user()->id.')');

        return view("backend.{$module_name}.create", compact('products', 'module_title', 'module_name', 'module_icon', 'module_action', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!auth()->user()->can('add_stage_users')) {
            abort(404);
        }

        // Validate incoming request data
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'stage_id' => 'required|exists:stages,id',
            'total' => 'required|integer|min:1',
        ]);

        // Get today's date
        $today = now()->toDateString(); // This gives the date in 'YYYY-MM-DD' format

        // Check if a stage_user entry for the same product and user exists today
        $stage_user = StageUser::where('product_id', $request->product_id)
            ->where('user_id', Auth::user()->id)
            ->whereDate('created_at', $today) // Check against created_at
            ->first();

        if ($stage_user) {
            // If it exists, increment the total
            $stage_user->update([
                'total' => $stage_user->total + intval($request->total)
            ]);
        } else {
            // If it doesn't exist, create a new entry
            StageUser::create(array_merge($request->all(), [
                'user_id' => Auth::user()->id,
                'created_at' => now(), // Set created_at to now
            ]));
        }

        Flash::success("<i class='fas fa-check'></i> Gửi báo cáo thành công")->important();

        return redirect()->back();
    }


    /**
     * Display the specified resource.
     */
    public function show(StageUser $stageUser)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Show';

        $$module_name_singular = $stageUser;

        Log::info(label_case($module_title.' '.$module_action).' | User:'.auth()->user()->name.'(ID:'.auth()->user()->id.')');

        return view(
            "backend.{$module_name}.show",
            compact('module_title', 'module_name', 'module_path', 'module_icon', 'module_action', 'module_name_singular', "{$module_name_singular}")
        );
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
        $productIds = $stageUser->pluck('product_id');
        $products = Product::whereIn('id', $productIds)->get();
        $stage_ids = $this->getStageByProductAndUserId($stageUser->product_id, auth()->user()->id);
        $group_stage_ids = $this->getGroupStageByProductAndUserId($stageUser->product_id, auth()->user()->id);
        Log::info(label_case($module_title.' '.$module_action)." | '".$$module_name_singular->name.'(ID:'.$$module_name_singular->id.") ' by User:".auth()->user()->name.'(ID:'.auth()->user()->id.')');

        return view(
            "backend.{$module_name}.edit",
            compact('module_title', 'stage_ids', 'group_stage_ids', 'stageUser', 'productIds', 'products', 'module_name', 'module_path', 'module_icon', 'module_action', 'module_name_singular', "{$module_name_singular}")
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

        $stageUser->update([
            'product_id' => $request->get('product_id'),
            'stage_id' => $request->get('stage_id'),
            'group_stage_id' => $request->get('group_stage_id'),
            'user_id' => auth()->user()->id,
            'total' => $request->get('total'),
        ]);

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

        $stageUser->update([
            'total' => null
        ]);

        Flash::success("<i class='fas fa-check'></i> Xóa thành công")->important();

        Log::info(label_case($module_title.' '.$module_action)." | '".$$module_name_singular->name.'(ID:'.$$module_name_singular->id.") ' by User:".auth()->user()->name.'(ID:'.auth()->user()->id.')');

        return redirect("admin/{$module_name}");
    }

    public function getStageByProductAndUserId($productId, $user_id) {
        $stageUser = StageUser::where('product_id', $productId)->where('user_id', $user_id)->first();

        // Lấy danh sách chi tiết của stage_ids và group_stage_ids
        $stageDetails = Stage::where('id', $stageUser->stage_id)->get(['id', 'name']);
        $groupStageDetails = StageGroup::where('id', $stageUser->group_stage_id)->get(['id', 'name']);

        return $stageDetails;
    }

    public function getGroupStageByProductAndUserId($productId, $user_id) {
        $stageUser = StageUser::where('product_id', $productId)->where('user_id', $user_id)->first();

        // Lấy danh sách chi tiết của stage_ids và group_stage_ids
        $stageDetails = Stage::where('id', $stageUser->stage_id)->get(['id', 'name']);
        $groupStageDetails = StageGroup::where('id', $stageUser->group_stage_id)->get(['id', 'name']);

        return $groupStageDetails;
    }

}
