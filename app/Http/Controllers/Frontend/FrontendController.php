<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\StageUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class FrontendController extends Controller
{
    public $module_title;

    public $module_name;

    public $module_path;

    public $module_icon;

    public $module_model;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Báo cáo';

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
     * Retrieves the view for the index page of the frontend.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        if (auth()->check()) {
            $module_title = $this->module_title;
            $module_name = $this->module_name;
            $module_path = $this->module_path;
            $module_icon = $this->module_icon;
            $module_model = $this->module_model;
            $module_name_singular = Str::singular($module_name);
    
            $$module_name_singular = Auth::user();
            $module_action = 'Create';
            $stage_users = StageUser::where('user_id', Auth::user()->id)->get();
            $productIds = $stage_users->pluck('product_id');
            $products = Product::whereIn('id', $productIds)->get();
            return view('frontend.index', compact('stage_users', 'products', 'module_name', 'module_name_singular', "{$module_name_singular}"));
        } else {
            return view('frontend.index');
        }
        
    }

    /**
     * Privacy Policy Page.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function privacy()
    {
        return view('frontend.privacy');
    }

    /**
     * Terms & Conditions Page.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function terms()
    {
        return view('frontend.terms');
    }
}
