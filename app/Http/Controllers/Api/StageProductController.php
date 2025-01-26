<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Product;
use App\Models\Stage;
use App\Models\StageGroup;
use App\Models\StageProduct;
use App\Models\StageUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Star\DataTables\Facades\DataTables;
use Star\Flash\Flash;

class StageProductController extends Controller
{
    public function getStagesByProduct($productId)
    {
        try {
            // Lấy thông tin StageProduct dựa trên product_id
            $stageProduct = StageProduct::where('product_id', $productId)->first();

            // Nếu không tìm thấy dữ liệu, trả về thông báo lỗi
            if (!$stageProduct) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy dữ liệu cho sản phẩm này.',
                ], 404);
            }

            // Lấy danh sách chi tiết của stage_ids và group_stage_ids
            $stageDetails = Stage::whereIn('id', $stageProduct->stage_ids)->get(['id', 'name']);
            $groupStageDetails = StageGroup::whereIn('id', $stageProduct->group_stage_ids)->get(['id', 'name']);

            // Trả về dữ liệu stage_ids và group_stage_ids chi tiết
            return response()->json([
                'success' => true,
                'stage_ids' => $stageDetails,
                'group_stage_ids' => $groupStageDetails,
            ]);
        } catch (\Exception $e) {
            // Xử lý lỗi bất ngờ
            return response()->json([
                'success' => false,
                'message' => 'Đã xảy ra lỗi trong quá trình xử lý.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function getStageByProductAndUserId($productId, $user_id) {
        try {
            // Lấy thông tin StageProduct dựa trên product_id
            $stageUser = StageUser::where('product_id', $productId)->where('user_id', $user_id)->first();

            // Nếu không tìm thấy dữ liệu, trả về thông báo lỗi
            if (!$stageUser) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy dữ liệu cho sản phẩm này.',
                ], 404);
            }

            // Lấy danh sách chi tiết của stage_ids và group_stage_ids
            $stageDetails = Stage::where('id', $stageUser->stage_id)->get(['id', 'name']);
            $groupStageDetails = StageGroup::where('id', $stageUser->group_stage_id)->get(['id', 'name']);

            // Trả về dữ liệu stage_ids và group_stage_ids chi tiết
            return response()->json([
                'success' => true,
                'stage_ids' => $stageDetails,
                'group_stage_ids' => $groupStageDetails,
            ]);
        } catch (\Exception $e) {
            // Xử lý lỗi bất ngờ
            return response()->json([
                'success' => false,
                'message' => 'Đã xảy ra lỗi trong quá trình xử lý.',
                'error' => $e->getMessage(),
            ], 500);
        }

    }
}
