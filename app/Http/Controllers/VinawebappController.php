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
class VinawebappController extends Controller
{
    function changeStatus(Request $request)
    {
        DB::table($request->tb)
            ->where('id', $request->id)
            ->update(['status' => $request->status]);
        return response()->json('Oke');
    }
}
