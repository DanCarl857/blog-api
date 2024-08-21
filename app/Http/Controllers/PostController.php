<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Post;
use App\Http\Controllers\Controller as Controller

class PostController extends Controller
{
    public function index()
    {
        // Get list of posts
        $posts = Post::all();
        $message = 'Post received successfully 🎉';
        $status = true;

        $response = $this->response($status, $posts, $message);
        return $response;
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $vaalidator = Validator::make($input, [
            'title' => 'required',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $post = Post::create($input);
        $message = "Post created successfully 🎉";
        $status = true;

        $response = $this->response($status, $blog, $message);
        return $response;
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            $message = $validator->errors();
            $post = [];
            $status = 'fail';
            $response = $this->response($status, $blog, $message);
            return $response;
        }

        $post = Post::find($id)->update(['title' => $input['title'], 'description' => $input['description']]);
        $message = 'Post update successfully 🎉';
        $status = true;

        $response = $this->response($status, $post, $message);
        return $response;
    }

    public function show($id)
    {
        $post = Post::find($id);

        if (is_null($post)) {
            $message = 'Post not found';
            $status = false;
            $response = $this->response($status, $blog, $message);
            return $response;
        }
        $message = 'Post retrieved successfully';
        $status = true;

        $response = $this->response($status, $post, $message);
        return $response;
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        $message = 'Post deleted successfully';
        $status = true;

        $response = $this->response($status, $post, $message);
        return $response;
    }

    public function response($status, $post, $message)
    {
        $return['success'] = $status;
        $return['data'] = $post;
        $return['message'] = $message;
        return $return;
    }
}
