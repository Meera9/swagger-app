<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Http\Resources\BlogResource;
use App\Models\Blog;



/**
 * @OA\OpenApi(
 *  @OA\Info(
 *      title="Returns Services For API FILE API",
 *      version="1.0.0",
 *      description="API documentation for Returns Service App",
 *      @OA\Contact(
 *          email="meerathanki09@gmail.com"
 *      )
 *  ),
 *  @OA\Server(
 *      description="Returns App API",
 *      url="http://swagger-app.test/api"
 *  ),
 *  @OA\PathItem(
 *      path="/api/suppliers"
 *  )
 * )
 * @OA\Post(
 *      path="/sign/in",
 *      operationId="store",
 *      tags={"Authantication"},
 *      summary="Sign in into application",
 *      description="Sign In into application",
 *      @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *            required={"email", "password"},
 *            @OA\Property(property="email", type="string", format="string", example="admin@admin.com"),
 *            @OA\Property(property="password", type="string", format="string", example="password"),
 *         ),
 *      ),
 *     @OA\Response(
 *          response=200, description="Success",
 *          @OA\JsonContent(
 *             @OA\Property(property="data",type="object")
 *          )
 *       )
 *  )
 */


class BlogController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @OA\Get(
     *    path="/blogs",
     *    operationId="blogList",
     *    tags={"Blogs"},
     *    summary="Get list of blogs",
     *    description="Get list of blogs",
     *    security={ {"passport": {} }},
     *     @OA\Response(
     *         response=200,
     *         description="List of blogs",
     *         @OA\JsonContent(
     *             type="object",
     *             example={
     *                 "data": {
     *                     {
     *                         "id": 1,
     *                         "title": "Dr.",
     *                         "description": "Voluptates dolorem facilis molestias voluptas optio et. Magnam exercitationem nulla neque est provident cum. Voluptatibus corrupti quam qui voluptatem maxime delectus. Tempora consequuntur fugit voluptatem qui adipisci enim.",
     *                         "created_at": "2023-10-28T16:47:58.000000Z",
     *                         "updated_at": "2023-10-28T16:47:58.000000Z"
     *                     }
     *                 },
     *                 "links": {
     *                     "first": "http://swagger-app.test/api/blogs?page=1",
     *                     "last": "http://swagger-app.test/api/blogs?page=2",
     *                     "prev": null,
     *                     "next": "http://swagger-app.test/api/blogs?page=2"
     *                 },
     *                 "meta": {
     *                     "current_page": 1,
     *                     "from": 1,
     *                     "last_page": 2,
     *                     "links": {
     *                         {
     *                             "url": null,
     *                             "label": "&laquo; Previous",
     *                             "active": false
     *                         },
     *                         {
     *                             "url": "http://swagger-app.test/api/blogs?page=1",
     *                             "label": "1",
     *                             "active": true
     *                         },
     *                         {
     *                             "url": "http://swagger-app.test/api/blogs?page=2",
     *                             "label": "2",
     *                             "active": false
     *                         },
     *                         {
     *                             "url": "http://swagger-app.test/api/blogs?page=2",
     *                             "label": "Next &raquo;",
     *                             "active": false
     *                         }
     *                     },
     *                     "path": "http://swagger-app.test/api/blogs",
     *                     "per_page": 10,
     *                     "to": 10,
     *                     "total": 20
     *                 }
     *             }
     *         )
     *     )
     *   )
     */
    public function index()
    {
        $blog = Blog::query()->paginate(10);
        return BlogResource::collection($blog);
    }

    /**
     * Store a newly created resource in storage.
     * @OA\Post(
     *     path="/blogs",
     *     summary="Create a new blog entry",
     *     tags={"Blogs"},
     *     security={ {"passport": {} }},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Blog entry data",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="title", type="string", example="New Blog Title"),
     *             @OA\Property(property="description", type="string", example="This is the content of the blog entry."),
     *         )
     *     ),
     * @OA\Response(
     *     response=200,
     *     description="Blog entry retrieved successfully",
     *     @OA\JsonContent(
     *         example={
     *             "data": {
     *                 "title": "New Blog Title",
     *                 "description": "This is the content of the blog entry.",
     *                 "updated_at": "2023-10-28T17:08:57.000000Z",
     *                 "created_at": "2023-10-28T17:08:57.000000Z",
     *                 "id": 21
     *             }
     *         }
     *     )
     * )
     * )
     */
    public function store(BlogRequest $blogRequest)
    {
        $blog = Blog::query()->create($blogRequest->validated());
        return BlogResource::make($blog);
    }

    /**
     * Display the specified resource.
     * @OA\Get(
     *     path="/api/blogs/{id}",
     *     summary="Retrieve a blog entry by ID",
     *     tags={"Blogs"},
     *     security={ {"passport": {} }},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the blog entry to retrieve",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     * @OA\Response(
     *     response=200,
     *     description="Blog entry retrieved successfully",
     *     @OA\JsonContent(
     *         example={
     *             "data": {
     *                 "title": "New Blog Title",
     *                 "description": "This is the content of the blog entry.",
     *                 "updated_at": "2023-10-28T17:08:57.000000Z",
     *                 "created_at": "2023-10-28T17:08:57.000000Z",
     *                 "id": 21
     *             }
     *         }
     *     )
     * ),
     *     @OA\Response(
     *         response=404,
     *         description="Blog entry not found"
     *     )
     * )
     */
    public function show(Blog $blog)
    {
        return BlogResource::make($blog);
    }

    /**
     * Update the specified resource in storage.
     * @OA\Patch(
     *     path="/api/blogs/{id}",
     *     summary="Update an existing blog entry",
     *     tags={"Blogs"},
     *     security={ {"passport": {} }},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the blog entry to be updated",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Updated blog entry data",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="title", type="string", example="Updated Blog Title"),
     *             @OA\Property(property="description", type="string", example="This is the updated content of the blog entry."),
     *         )
     *     ),
     * @OA\Response(
     *     response=200,
     *     description="Blog entry retrieved successfully",
     *     @OA\JsonContent(
     *         example={
     *             "data": {
     *                 "title": "New Blog Title",
     *                 "description": "This is the content of the blog entry.",
     *                 "updated_at": "2023-10-28T17:08:57.000000Z",
     *                 "created_at": "2023-10-28T17:08:57.000000Z",
     *                 "id": 21
     *             }
     *         }
     *     )
     * ),
     *     @OA\Response(
     *         response=404,
     *         description="Blog entry not found"
     *     )
     * )
     */
    public function update(BlogRequest $request, Blog $blog)
    {
        $blog = Blog::query()->findOrFail($blog->id);
        $blog->update($request->validated());
        return BlogResource::make($blog);
    }

    /**
     * Remove the specified resource from storage.
     * @OA\Delete(
     *     path="/api/blogs/{id}",
     *     summary="Delete a blog entry by ID",
     *     tags={"Blogs"},
     *     security={ {"passport": {} }},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the blog entry to delete",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Blog entry deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Blog entry not found"
     *     )
     * )
     */
    public function destroy(Blog $blog)
    {
        $blog = Blog::query()->findOrFail($blog->id);
        return $blog->delete();
    }
}
