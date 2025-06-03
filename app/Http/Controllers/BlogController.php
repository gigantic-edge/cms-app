<?php

namespace App\Http\Controllers;

use App\Models\BlogModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    //
    public function blogs(Request $request)
    {
        $userId             = $request->session()->get('user_id');
        $data['blogs'] = BlogModel::where('is_deleted', '=', '0')->where('created_by','=',$userId)->orderBy("id", 'DESC')->paginate(10);
        // echo '<pre>';
        // print_r($data['blogs']);die;
        $title              = 'Blogs';
        $page_name          = 'admin.module.blogs.blogs';
        echo $this->admin_after_login_layout($title, $page_name, $data);
    }
    public function addBlog(Request $request)
    {
        $userId             = $request->session()->get('user_id');
        $data               = [];
        $title              = 'Add Blog';
        $page_name          = 'admin.module.blogs.add-blog';
        if ($request->isMethod('post')) {
            $validatedData  = $request->validate([
                'name'              => 'required|string|max:200',
                'description'       => 'required',
                'image'             => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
                'order'             => 'required|numeric',
            ]);
            if ($validatedData) {

                /**image upload */
                $file           = $request->file('image');
                $originalName   = $file->getClientOriginalName();
                $fileName       = time() . '_' . $originalName;
                $path           = 'images/blogs';
                $file->storeAs($path, $fileName, 'public');
                /**image upload */

                $postedData = [
                    'title'                  => $validatedData['name'],
                    'slug'                  => Str::slug($validatedData['name']),
                    'description'           => $validatedData['description'],
                    'image'                  => $fileName,
                    'ranking'               => $validatedData['order'],
                    'created_by'            => $userId
                ];
                if (BlogModel::insert($postedData)) {
                    return redirect('/Administrator/blogs')->with([
                        'message' => 'Blog Successfully Inserted !!.',
                        'type'    => 'success',
                    ]);
                } else {
                    return redirect('/Administrator/blogs')->with([
                        'message' => 'Blog is not inserted !!.',
                        'type'    => 'error',
                    ]);
                }
            }
        }
        echo $this->admin_after_login_layout($title, $page_name, $data);
    }
   public function editBlog(Request $request, $id)
{
    $userId         = $request->session()->get('user_id');
    $blog           = BlogModel::findOrFail($id);
    $data['blog']   = $blog;

    if ($request->isMethod('post')) {
        $validatedData = $request->validate([
            'name'        => 'required|string|max:200',
            'description' => 'required',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order'       => 'required|numeric',
        ]);

        $postedData = [
            'title'       => $validatedData['name'],
            'slug'        => Str::slug($validatedData['name']),
            'description' => $validatedData['description'],
            'ranking'     => $validatedData['order'],
            'created_by'  => $userId
        ];

        if ($request->hasFile('image')) {
            // Delete old image
            if ($blog->image && file_exists(public_path('storage/images/blogs/' . $blog->image))) {
                unlink(public_path('storage/images/blogs/' . $blog->image));
            }

            // Upload new image
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('images/blogs', $fileName, 'public');
            $postedData['image'] = $fileName;
        }

        $updateResult = $blog->update($postedData);

        if ($updateResult) {
            return redirect('/Administrator/blogs')->with([
                'message' => 'Blog Successfully Updated!',
                'type'    => 'success',
            ]);
        } else {
            return redirect('/Administrator/blogs')->with([
                'message' => 'Failed to update the Blog.',
                'type'    => 'error',
            ]);
        }
    }

    $title     = 'Edit Blog';
    $page_name = 'admin.module.blogs.edit-blog';

    return $this->admin_after_login_layout($title, $page_name, $data);
}

    public function deleteBlog($id)
    {
        $postedData     = [
            'is_deleted' => '1',
        ];
        BlogModel::where('id', '=', $id)->update($postedData);
        return redirect()->back()->with([
            'message' => 'Blog Successfully Deleted !!.',
            'type'    => 'success',
        ]);
    }
}
