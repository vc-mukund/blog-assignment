<?php

namespace App\Http\Controllers\Backend\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Blog\BlogCreateRequest;
use App\Http\Requests\Backend\Blog\BlogUpdateRequest;
use App\Services\Backend\Blog\BlogServices;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

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
        try {
            $blogs = $this->blog->editorBlogList();

            return view('backend.admin.blog.index', compact('blogs'));
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    /**
     * For show add blog page.
     *
     * @return Illuminate View/View
     */
    public function create(): View
    {
        try {
            return view('backend.admin.blog.add-blog');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    /**
     * For Store blog in database.
     *
     * @param  BlogCreateRequest  $request
     * @return RedirectResponse
     */
    public function store(BlogCreateRequest $request): RedirectResponse
    {
        try {
            $this->blog->blogStore($request->only('id', 'title', 'description', 'body', 'status', 'user_id', 'image'));

            return redirect()->route('admin.blog.index');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    /**
     * For show form for edit blog
     *
     * @param  int  $id
     * @return Iluminate/View/View
     */
    public function edit(int $id): View
    {
        try {
            $blog = $this->blog->findBlog($id);

            if ($blog->user_id == Auth::user()->id) {
                return view('backend.admin.blog.edit-blog', compact('blog'));
            } else {
                return redirect()->route('admin.blog.index');
            }
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
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
        try {
            $this->blog->blogStore($request->only('id', 'title', 'description', 'body', 'status', 'user_id', 'image'));

            return redirect()->route('admin.blog.index');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    /**
     * For delete user from database
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        try {
            if ($id == Auth::user()->id) {
                $this->services->findBlog($id)->delete();
            }

            return redirect()->route('admin.blog.index');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    /**
     * For show all blog for admin
     *
     * @param Illuminate\View\View
     */
    public function indexAdmin(): View
    {
        try {
            $blogs = $this->blog->adminBlogList();

            return view('backend.admin.blog.index', compact('blogs'));
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }
}
