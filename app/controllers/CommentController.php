<?php

class CommentController extends \BaseController
{

    public $restful = true;

    public function __construct()
    {
        $this->beforeFilter('logged_in');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $input = Input::all();
        return ApiResponse::json(Comment::all());
//        return ApiResponse::json(array('user' => $input->toArray()));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $user = Token::userFor(Input::get('token'));
        $blether = Blether::find(Input::get('blether_id'));

        $comment = new Comment;


        $comment->blether()->associate($blether);
        $comment->user()->associate($user);
        $comment->content = Input::get('content');
        $comment->save();


        return ApiResponse::json(array('success' => true, 'input' => Input::all()));
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }


}
