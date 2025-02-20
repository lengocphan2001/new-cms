<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Salary;
use App\Models\StageUser;
use App\Models\User;
use App\Models\SalaryDetail;
use Illuminate\Http\Request;
use App\Models\Permission;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Star\DataTables\Facades\DataTables;
use Star\Flash\Flash;
class SalaryController extends Controller
{
    public $module_title;

    public $module_name;

    public $module_path;

    public $module_icon;

    public $module_model;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Tính lương';

        // module name
        $this->module_name = 'salaries';

        // directory path of the module
        $this->module_path = 'salaries';

        // module icon
        $this->module_icon = 'fa-solid fa-user-shield';

        // module model name, path
        $this->module_model = "App\Models\Salary";
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Khai báo các biến cần thiết cho tiêu đề module và các thuộc tính khác
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_action = 'List';
        $module_name_singular = Str::singular($module_name);
        $page_heading = ucfirst($module_title);
        $title = $page_heading.' '.ucfirst($module_action);
        

        $$module_name = User::with('salaries')  
            ->whereHas('roles', function ($query) {  
                $query->where('name', 'user');
            })
            ->paginate(10);  // Phân trang kết quả

        
        // Log hoạt động người dùng
        Log::info(label_case($module_title.' '.$module_action).' | User:'.auth()->user()->name.'(ID:'.auth()->user()->id.')');

        // Trả về view và truyền các biến cần thiết
        return view(
            "backend.{$module_path}.index",
            compact('module_title', 'module_name', "{$module_name}", 'module_icon', 'module_name_singular', 'module_action', 'page_heading', 'title')
        );
    }

    public function salaryDetails(User $user)
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
        // Lấy tất cả các bản ghi lương của người dùng
        $salaries = $user->salaries;

        return view(
            "backend.{$module_path}.salary_details",
            compact('module_title', 'salaries', 'user', 'module_name', "{$module_name}", 'module_icon', 'module_name_singular', 'module_action', 'page_heading', 'title')
        );
    }



    public function calculateSalary($user_id, $month, $year)
    {
        // Lấy hoặc tạo bản ghi lương cho nhân viên và tháng năm
        $salary = Salary::firstOrCreate([
            'user_id' => $user_id,
            'month' => $month,
            'year' => $year,
        ]);

        // Lấy dữ liệu từ bảng stage_user để tính lương sản phẩm
        $stage_users = StageUser::where('user_id', $user_id)
                                ->where('total', '!=', null)
                                ->whereMonth('created_at', $month)
                                ->whereYear('created_at', $year)
                                ->get();

        // Tính các khoản phụ cấp
        $allowance = 600000; // Phụ cấp cố định
        $daily_food_allowance = 20000 * count($stage_users); // Tiền ăn
        $daily_transport_allowance = 20000 * count($stage_users); // Tiền xăng xe
        $special_allowance = 400 * count($stage_users); // Tiền chuyên cần (có thể điều chỉnh theo số ngày làm việc)

        // Tính lương sản phẩm
        $product_salary = 0;
        foreach ($stage_users as $stage_user) {
            $product_salary += $stage_user->total * $stage_user->stage->price; 
        }

        // Tính tổng lương
        $total_salary = $allowance + $daily_food_allowance + $daily_transport_allowance + $special_allowance + $product_salary;

        // Lưu vào bảng salary_details
        $salary_detail = SalaryDetail::create([
            'salary_id' => $salary->id,
            'allowance' => $allowance,
            'allowances' => $daily_food_allowance + $daily_transport_allowance + $special_allowance,
            'product_salary' => $product_salary,
            'total_salary' => $total_salary,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Salary calculated and saved successfully.',
            'data' => $salary_detail,
        ]);
    }




    /**
     * Show the form for creating a new resource.
     */
    public function createSalaryDetail(User $user)
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

        return view("backend.{$module_name}.create", compact('module_title', 'user', 'module_name', 'module_icon', 'module_action', 'permissions'));
    }


    public function postSalaryDetail(Request $request, User $user)
    {
        $month = $request->get('month'); // Tháng từ request
        $year = $request->get('year'); // Năm từ request

        $this->calculateSalary($user->id, $month, $year);

        Flash::success("<i class='fas fa-check'></i> Tạo phiếu lương thành công")->important();
        // Chuyển hướng hoặc trả về view sau khi tính lương xong
        return redirect()->back();
    }

    public function showSalaryDetail(SalaryDetail $salaryDetail)
    {
        $module_title = 'Salary Detail';
        $module_name = 'salary_details';
        $module_path = $this->module_path;
        $module_icon = 'fas fa-dollar-sign';
        $module_model = SalaryDetail::class;
        $module_action = 'List';
        $module_name_singular = Str::singular($module_name);
        $page_heading = ucfirst($module_title);
        $title = $page_heading . ' ' . ucfirst($module_action);
        $module_action = 'Show';

        $$module_name_singular = $salaryDetail;

        Log::info(label_case($module_title.' '.$module_action).' | User:'.auth()->user()->name.'(ID:'.auth()->user()->id.')');

        return view(
            "backend.salaries.show_salary_detail",
            compact('module_title', 'module_name', 'module_path', 'module_icon', 'module_action', 'module_name_singular', "{$module_name_singular}")
        );
    }


    public function deleteSalaryDetail(SalaryDetail $salaryDetail)
    {
        $module_title = 'Salary Detail';
        $module_name = 'salary_details';
        $module_path = $this->module_path;
        $module_icon = 'fas fa-dollar-sign';
        $module_model = SalaryDetail::class;
        $module_action = 'List';
        $module_name_singular = Str::singular($module_name);
        $page_heading = ucfirst($module_title);
        $title = $page_heading . ' ' . ucfirst($module_action);

        $module_action = 'Show';

        $$module_name_singular = $salaryDetail;
        $salaryDetail->delete();

        Flash::success("<i class='fas fa-check'></i> Xóa phiếu lương thành công")->important();
        Log::info(label_case($module_title.' '.$module_action).' | User:'.auth()->user()->name.'(ID:'.auth()->user()->id.')');

        return redirect()->back();
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
    public function show(Salary $salary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Salary $salary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Salary $salary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Salary $salary)
    {
        if (! auth()->user()->can('delete_salaries')) {
            abort(404);
        }

        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Delete';

        $$module_name_singular = $salary;

        $salary->delete();

        Flash::success("<i class='fas fa-check'></i> Xóa thành công")->important();

        Log::info(label_case($module_title.' '.$module_action)." | '".$$module_name_singular->name.'(ID:'.$$module_name_singular->id.") ' by User:".auth()->user()->name.'(ID:'.auth()->user()->id.')');

        return redirect()->back();
    }
}
