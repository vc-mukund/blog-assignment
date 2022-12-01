<?php

namespace App\Services\Backend\Blog;

use App\Models\User;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BLogServices
{
    /**
     * BlogService Constructor
     *
     * @param  User  $user
     * @param  Blog  $blog
     * @return void
     */
    public function __construct(
        protected User $user,
        protected Blog $blog,
    ) {
    }

    /**
     * For show all editor Blog list
     *
     * @return object
     */
    public function editorBlogList(): object
    {
        try {
            return $this->blog->with('user')->User()->orderBy('created_at', 'DESC')->get();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    /**
     * For find Specific blog
     *
     * @param int $id
     * @return Blog
     */
    public function findBlog(int $id): Blog
    {
        try {
            return $this->blog->find($id);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    /**
     * create and update blog in database
     *
     * @param array $data
     * @return void
     */
    public function blogStore(array $data)
    {
        try {
            $storeArr = [
                'title' => $data['title'],
                'description' => $data['description'],
                'body' => $data['body'],
                'status' => $data['status'],
                'user_id' => Auth::user()->id,
            ];
            if (isset($data['image']) && !empty($data['image'])) {
                $storeArr['image'] = $this->storeImage($data);
            }
            $this->blog->updateOrCreate(
                ['id' => $data['id']],
                $storeArr
            );
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    /**
     * For store blog image in database
     *
     * @param array $data
     * @return string
     */
    public function storeImage(array $data): string
    {
        try {
            $image = $data['image'];
            $extension = $image->extension();
            $imageName = time() . '.' . $extension;
            $image->storeAs('/public/image', $imageName);

            return $imageName;
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    /**
     * For show all Blog list to admin
     *
     * @return object
     */
    public function adminBlogList(): object
    {
        try {
            return Blog::all();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }
}
