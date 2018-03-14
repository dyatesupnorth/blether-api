<?php

class BletherController extends \BaseController
{
    public $restful = true;

    public function __construct()
    {
        $this->beforeFilter('logged_in');
    }

    /**
     * Send back all comments as JSON
     *
     * @return ApiResponse
     */
    public function index()
    {


//        $authenticatedUser = Token::userFor(Input::get('token'));

        /*$blethers = Blether::whereHas('users', function ($query) use ($user) {
            $query->where('user_id', '=', $user->_id);
        })->get();*/
        $user = User::find(Input::get('userId'));

        $blethers = Blether::where('user_id', $user->_id)->orderBy('updated_at', 'DESC')->get();
//        $blethers = $user->blethers->get($user->_id);
        $blethers->each(function ($blether) {
            $blether->user = User::find(Input::get('userId'));
            $blether->tags = $blether->tags()->get();
            $blether->comments = Blether::find($blether->_id)->comments;
            $blether->comments->each(function ($comment) {
                $comment->user = Comment::find($comment->_id)->user;

            });
        });


        return ApiResponse::json(array(
            'input' => Input::all(),
            'user' => $user,
            'blethers' => $blethers,
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return ApiResponse
     */
    public function store()
    {
        $user = Token::userFor(Input::get('token'));

        if (Input::file('file')) {
            $file = Input::file('file');
            $destinationPath = 'public/images/blethers';
            $extension = $file->getClientOriginalExtension();
            $filename = substr("abcdefghijklmnopqrstuvwxyz", mt_rand(0, 25), 1) . substr(md5(time()), 1) . ".{$extension}";
            $file->move($destinationPath, $filename);

            Blether::create(array(
                'user_id' => $user->_id,
                'hasImage' => 1,
                'subject' => Input::get('subject'),
                'image' => $filename
            ));

            return ApiResponse::json(array(
                'success' => true,
                'input' => Input::all(),
                'file' => $filename,


            ));
        }else{
            Blether::create(array(
                'subject' => Input::get('subject'),
                'user_id' => $user->_id
            ));

            return ApiResponse::json(array(
                'success' => true,
                'input' => Input::all()
            ));
        };



    }


    /**
     * Return the specified resource using JSON
     *
     * @param  int $id
     * @return ApiResponse
     */
    public function show($id)
    {
        return ApiResponse::json(Blether::find($id));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return ApiResponse
     */
    public function update($id)
    {
        return ApiResponse::json(Blether::find($id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return ApiResponse
     */
    public function destroy($id)
    {
        Blether::destroy($id);

        return ApiResponse::json(array('success' => true));
    }

}