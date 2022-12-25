<?php

namespace App\Services\Backend\Blog;

use App\Constant\Constant;
use App\Services\Core\Services;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * This services provide different method such as 
 * find specific existing blog data, 
 * fetch all blogs, 
 * create newly and update existing blog.  
 */
class BlogServices extends Services
{
    /**
     * BlogService Constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->modelBlog = config('model-variable.models.blog.class');
    }

    /**
     * For show all editor Blog list
     *
     * @return object
     */
    public function editorBlogList(): object
    {
        try {
            return $this->modelBlog::with('user')->User()->orderBy('created_at', 'DESC')->get();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    /**
     * For find Specific blog
     *
     * @param int $id
     * @return Model
     */
    public function findBlog(int $id): Model
    {
        try {
            return $this->modelBlog::findOrFail($id);
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
    public function blogStore($data): bool
    {
        $response = Constant::STATUS_FALSE;
        DB::beginTransaction();
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
            $this->modelBlog::updateOrCreate(
                ['id' => $data['id']],
                $storeArr
            );
            DB::commit();
            $response = Constant::STATUS_TRUE;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());
        }
        return $response;
    }

    /**
     * For store blog image in database
     *
     * @param array $data
     * @return string
     */
    public function storeImage($data): string
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
            return $this->modelBlog::orderBy('created_at', 'DESC')->get();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }
}
