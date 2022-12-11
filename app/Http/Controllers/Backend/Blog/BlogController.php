<?php

namespace App\Http\Controllers\Backend\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Blog\BlogCreateRequest;
use App\Http\Requests\Backend\Blog\BlogUpdateRequest;
use App\Services\Backend\Blog\BlogServices;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * This controller provide different method such as 
 * display specific exisitng resource, 
 * lisiting all resource, 
 * create newly and update existing resouce and  
 * delete specifirc existing resource.
 */
class BlogController extends Controller
{
    /**
     * BlogController Constructor
     *
     * @param  BlogSerivecs  $blog
     * @return void
     */
    public function __construct(
        protected BlogServices $blog,
    ) {
    }

    /**
     * For Show the all editor wise blog list.
     *
     * @return Illuminate View\View
     */
    public function index(): View
    {
        $blogs = $this->blog->editorBlogList();

        return view('backend.admin.blog.index', compact('blogs'));
    }

    /**
     * For show add blog page.
     *
     * @return Illuminate View/View
     */
    public function create(): View
    {

        return view('backend.admin.blog.add-blog');
    }

    /**
     * For Store blog in database.
     *
     * @param  BlogCreateRequest  $request
     * @return RedirectResponse
     */
    public function store(BlogCreateRequest $request): RedirectResponse
    {
        $this->blog->blogStore($request);

        return redirect()->route('admin.blog.index')->with('success', 'Blog successfully registered!');
    }

    /**
     * For show form for edit blog
     *
     * @param  int  $id
     * @return mixed
     */
    public function edit(int $id): mixed
    {
        $blog = $this->blog->findBlog($id);

        if ($blog->user_id == Auth::user()->id) {
            return view('backend.admin.blog.edit-blog', compact('blog'));
        } else {
            return redirect()->route('admin.blog.index')->with('danger', "You have not access to edit another user's blog");
        }
    }

    /**
     * For update specific blog.
     *
     * @param  BlogUpdateRequest  $request
     * @return RedirectResponse
     */
    public function update(BlogUpdateRequest $request): RedirectResponse
    {
        $this->blog->blogStore($request);

        return redirect()->route('admin.blog.index')->with('success', 'Blog successfully updated!');
    }

    /**
     * For delete user from database
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        if ($id == Auth::user()->id) {
            $this->services->findBlog($id)->delete();
        }

        return redirect()->route('admin.blog.index')->with('success', 'Blog successfully deleted!');
    }

    /**
     * For show all blog for admin
     *
     * @param Illuminate\View\View
     */
    public function indexAdmin(): View
    {
        $blogs = $this->blog->adminBlogList();

        return view('backend.admin.blog.index', compact('blogs'));
    }
}
