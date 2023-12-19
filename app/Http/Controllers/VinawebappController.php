<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\CategoryProject;
use App\Models\ListSlug;
use App\Models\ListImage;
use App\Models\ListView;
use App\Models\Province;
use App\Models\District;
use App\Models\Ward;
class VinawebappController extends Controller
{
    function changeStatus(Request $request)
    {
        DB::table($request->tb)
            ->where('id', $request->id)
            ->update(['status' => $request->status]);
        return response()->json('Oke');
    }
    function changeHighlight(Request $request)
    {
        DB::table($request->tb)
            ->where('id', $request->id)
            ->update(['highlight' => $request->highlight]);
        return response()->json('Oke');
    }
    function deleteItems(Request $request)
    {
        if ($request->trash == true) {
            DB::table($request->tb)
                ->whereIn('id', $request->dataId)
                ->update(['deleted_at' => now()]);
            return response()->json('Đã đưa dữ liệu vào thùng rác');
        } else {
            DB::table($request->tb)
                ->whereIn('id', $request->dataId)
                ->delete();
            return response()->json('Xóa dữ liệu thành công');
        }
    }
    function restoreItems(Request $request)
    {
        DB::table($request->tb)
            ->whereIn('id', $request->dataId)
            ->update(['deleted_at' => null]);
        return response()->json('Khôi phục dữ liệu thành công');
    }
    function changeORD(Request $request)
    {
        DB::table($request->tb)
            ->where('id', $request->id)
            ->update(['ord' => $request->value]);
        return response()->json('Update ORD Success');
    }

    function getDataDistrict($id)
    {
        $data = District::where('id_province', $id)->get();
        return response()->json(['data' => $data]);
    }
    function getDataWard($id)
    {
        $data = Ward::where('id_district', $id)->get();
        return response()->json(['data' => $data]);
    }
}
