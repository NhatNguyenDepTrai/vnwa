<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryProject;
use App\Models\ListSlug;
use App\Models\ListImage;

class CategoryProjectController extends Controller
{
    public function createSlug($slug)
    {
        $check = ListSlug::where('slug', $slug)->first();
        return $check ? true : false;
    }

    public function create(Request $rq)
    {
        $tb = 'category_project';
        $listSubImage = $rq->listSubImage;
        $data = [];
        $data['url_bg'] = $rq->url_bg;
        $data['desc'] = $rq->desc;
        $data['content'] = $rq->content;

        if (!$rq->url_avatar) {
            return response()->json(['error' => 'Vui lòng chọn ảnh đại diện', 'column' => 'url_avatar']);
        } else {
            $data['url_avatar'] = $rq->url_avatar;
        }

        if (!$rq->url_avatar_mobile) {
            $data['url_avatar_mobile'] = $rq->url_avatar;
        } else {
            $data['url_avatar_mobile'] = $rq->url_avatar_mobile;
        }

        if (!$rq->name) {
            return response()->json(['error' => 'Vui lòng nhập tên dữ liệu', 'column' => 'name']);
        } else {
            $data['name'] = $rq->name;
        }

        if (!$rq->slug) {
            return response()->json(['error' => 'Có lỗi xảy ra, không cập nhập được slug, hãy load lại trang', 'column' => 'slug']);
        } else {
            if ($this->createSlug($rq->slug)) {
                return response()->json(['error' => 'Đã có đường dẫn này, nhập đường dẫn khác để tối ưu SEO', 'column' => 'slug']);
            }
            $data['slug'] = $rq->slug;
        }

        if (!$rq->meta_title) {
            return response()->json(['error' => 'Vui lòng nhập tiêu đề link để tối ưu SEO', 'column' => 'meta_title']);
        } else {
            $data['meta_title'] = $rq->meta_title;
        }

        if (!$rq->meta_image) {
            return response()->json(['error' => 'Vui lòng chọn ảnh link để tối ưu SEO', 'column' => 'meta_image']);
        } else {
            $data['meta_image'] = $rq->meta_image;
        }

        if (!$rq->meta_desc) {
            return response()->json(['error' => 'Vui lòng nhập mô tả link để tối ưu SEO', 'column' => 'meta_desc']);
        } else {
            $data['meta_desc'] = $rq->meta_desc;
        }

        $id_tb = CategoryProject::create($data)->id;
        ListSlug::create([
            'tb' => $tb,
            'id_tb' => $id_tb,
            'name' => $rq->name,
            'slug' => $rq->slug,
        ]);

        foreach ($listSubImage as $key => $value) {
            ListImage::create([
                'tb' => $tb,
                'id_tb' => $id_tb,
                'url_image' => $value,
            ]);
        }
        return response()->json(['success' => 'Cập nhập dữ liệu thành công']);
    }
}
