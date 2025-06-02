<?php

namespace App\Http\Controllers;

use App\Models\BlogModel;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    //
    public function blogs()
    {
        $data['blogs']    =      BlogModel::where('is_deleted', '=', '0')->where('status', '=', 'active')->orderBy("id", 'DESC')->paginate(6);
        $title                   = 'CMS-App';
        $page_name               = 'frontend.blog';
        echo $this->frontend_layout($title, $page_name, $data);
    }
     public function blogDetails(Request $request, $slug)
    {
        $data['blog_detail']     = BlogModel::where('slug', '=', $slug)->first();
        // echo '<pre>';
        // print_r($data['blog_detail']);
        $blogId     = $data['blog_detail']->id;
        $data['relatedBlogs'] = BlogModel::where('id', '!=', $blogId)
                        ->latest()
                        ->take(3) 
                        ->get();
        if (!$data['blog_detail']) {
            abort(404, 'Blog not found.');
        }
        $title          = 'CMS-APP';
        $page_name      = 'frontend.blog-details';
        return $this->frontend_layout($title, $page_name, $data);
    }
}
