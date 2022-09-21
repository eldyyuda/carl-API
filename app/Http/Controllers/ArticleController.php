<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Http\Resources\ArticleCollection;
use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ArticleResource;
use Illuminate\Support\Facades\Response;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // gunakan resource collection jika tanpa response jika ada gunakan resoure dengan menghilangkan new hanya ArticleResource::c b                
        $article = Article::paginate(2);
        return new ArticleCollection($article);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        // $request->validate([
        //     'title' => 'required|min:3|max:255',
        //     'body' => 'required',
        //     'subject' => 'required'
        // ]);

        $article = Auth::user()->articles()->create([
            'title' => request('title'),
            'slug' => Str::slug(request('title')),
            'body' => request('body'),
            'subject_id' => request('subject'),
        ]);

        return $article;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return response([
            'status' => 'success',
            'data' => new ArticleResource($article)
        ]);


        //return new ArticleResource($article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, Article $article = null)
    {
        $article->update($this->articleStore());
        return new ArticleResource($article);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article = null)
    {
        $article->delete();
        return Response::json('The article was successfully deleted', 200);
    }
    public function articleStore()
    {
        return [
            'title' => request('title'),
            'slug' => Str::slug(request('title')),
            'body' => request('body'),
            'subject_id' => request('subject'),
        ];
    }
}
