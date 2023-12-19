<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Province;
use App\Models\District;
use App\Models\Ward;

class CompanyController extends Controller
{
    function showCompany()
    {
        $data = Company::first();
        $dataProvince = Province::all();
        $dataDistrict = District::where('id_province', $data->province)->get();
        $dataWard = Ward::where('id_district', $data->district)->get();
        return Inertia::render('Company', ['data' => $data, 'dataProvince' => $dataProvince, 'dataDistrict' => $dataDistrict, 'dataWard' => $dataWard]);
    }
    function UpdateCompany(Request $request)
    {
        if (!$request->url_avatar_full) {
            return response()->json(['error' => 'Vui lòng chọn logo full', 'column' => 'url_avatar_full']);
        } else {
            $data['url_avatar_full'] = $request->url_avatar_full;
        }

        if (!$request->url_avatar_icon) {
            return response()->json(['error' => 'Vui lòng chọn logo icon', 'column' => 'url_avatar_icon']);
        } else {
            $data['url_avatar_icon'] = $request->url_avatar_icon;
        }

        if (!$request->url_favicon) {
            return response()->json(['error' => 'Vui lòng chọn favicon', 'column' => 'url_favicon']);
        } else {
            $data['url_favicon'] = $request->url_favicon;
        }

        if (!$request->name) {
            return response()->json(['error' => 'Vui lòng nhập tên công ty', 'column' => 'name']);
        } else {
            $data['name'] = $request->name;
        }
        if (!$request->short_name) {
            return response()->json(['error' => 'Vui lòng nhập tên công ty viết tắt', 'column' => 'short_name']);
        } else {
            $data['short_name'] = $request->short_name;
        }
        if (!$request->slogan) {
            return response()->json(['error' => 'Vui lòng nhập slogan', 'column' => 'slogan']);
        } else {
            $data['slogan'] = $request->slogan;
        }
        if (!$request->sub_slogan) {
            return response()->json(['error' => 'Vui lòng nhập sub_slogan', 'column' => 'sub_slogan']);
        } else {
            $data['sub_slogan'] = $request->sub_slogan;
        }
        if (!$request->website) {
            return response()->json(['error' => 'Vui lòng nhập link website', 'column' => 'website']);
        } else {
            $data['website'] = $request->website;
        }
        if (!$request->phone) {
            return response()->json(['error' => 'Vui lòng nhập số điện thoại', 'column' => 'phone']);
        } else {
            $data['phone'] = $request->phone;
        }
        if (!$request->hotline) {
            return response()->json(['error' => 'Vui lòng nhập hotline', 'column' => 'hotline']);
        } else {
            $data['hotline'] = $request->hotline;
        }
        if (!$request->support_mail) {
            return response()->json(['error' => 'Vui lòng nhập hotline', 'column' => 'support_mail']);
        } else {
            $data['support_mail'] = $request->support_mail;
        }

        if (!$request->province) {
            return response()->json(['error' => 'Vui lòng chọn tỉnh, thành phố', 'column' => 'province']);
        } else {
            $data['province'] = $request->province;
        }
        if (!$request->district) {
            return response()->json(['error' => 'Vui lòng chọn quận, huyện', 'column' => 'district']);
        } else {
            $data['district'] = $request->district;
        }
        if (!$request->ward) {
            return response()->json(['error' => 'Vui lòng chọn phường, xã, thị trấn', 'column' => 'ward']);
        } else {
            $data['ward'] = $request->ward;
        }
        if (!$request->address) {
            return response()->json(['error' => 'Vui lòng nhập số nhà, tên đường', 'column' => 'address']);
        } else {
            $data['address'] = $request->address;
        }

        if (!$request->meta_image) {
            return response()->json(['error' => 'Vui lòng chọn meta image', 'column' => 'meta_image']);
        } else {
            $data['meta_image'] = $request->meta_image;
        }

        if (!$request->meta_title) {
            return response()->json(['error' => 'Vui lòng nhập meta title', 'column' => 'meta_title']);
        } else {
            $data['meta_title'] = $request->meta_title;
        }

        if (!$request->meta_desc) {
            return response()->json(['error' => 'Vui lòng nhập meta desc', 'column' => 'meta_desc']);
        } else {
            $data['meta_desc'] = $request->meta_desc;
        }

        if (!$request->about) {
            return response()->json(['error' => 'Vui lòng nhập phần giới thiệu công ty', 'column' => 'about']);
        } else {
            $data['about'] = $request->about;
        }

        $data['zalo'] = $request->zalo;
        $data['facebook'] = $request->facebook;
        $data['intagrams'] = $request->intagrams;
        $data['yotube'] = $request->yotube;

        Company::find(1)->update($data);
        return true;
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
