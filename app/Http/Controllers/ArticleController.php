<?php

namespace App\Http\Controllers;

use App\Article;
use Exception;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $error = 0;
        $message = 'success';
        try{
            $data = Article::all();
        }
        catch (Exception $e)
        {
            $error = 1;
            $message = $e->getMessage();
        }
        $res = response()->json(
            [
            'error'=>$error,
            'message'=>$message,
            'data'=>$data
            ]
        );
        return $res;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [];
        $error = 0;
        $message = 'success';
        try
        {
            $validated = $request->validate([
                'title' => 'required',
                'body' =>'required'
            ]);

           $data = Article::create($validated);
        }
        catch(Exception $e)
        {
            $error = 1;
            $message = $e->getMessage();
        }
        $res = response()->json(
            [
            'error'=>$error,
            'message'=>$message,
            'data'=>$data
            ]
        );
        return $res;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [];
        $error = 0;
        $message = 'success';
        try
        {
          $data = Article::findOrFail($id);
        }
        catch(Exception $e)
        {
          $message = $e->getMessage();
          $error = 1;
        }
        $res = response()->json(
                [
                'error'=>$error,
                'message'=>$message,
                'data'=>$data
                ]
            );
        return $res;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = [];
        $error = 0;
        $message = 'success';
        try
        {
            $data = Article::findOrFail($id);
            $data->update($request->all());
        }
        catch(Exception $e)
        {
            $message = $e->getMessage();
            $error = 1;
        }
        $res = response()->json(
                        [
                        'error'=>$error,
                        'message'=>$message,
                        'data'=>$data
                        ]
                    );
        return $res;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return 204;
    }
}
