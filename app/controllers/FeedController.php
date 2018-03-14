<?php

/**
 * Created by PhpStorm.
 * User: master-d
 * Date: 11/01/15
 * Time: 21:05
 */
class FeedController extends \BaseController
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


        $user = Token::userFor(Input::get('token'));

        $friendships = Friend::where('user_id', $user->_id)->get();


        $blethers = DB::table('blethers')
            ->select('blethers._id','blethers.user_id','blethers.hasImage', 'blethers.subject', 'blethers.image AS bletherImage','blethers.updated_at','users.firstname', 'users.lastname', 'users.image AS userImage')
            ->join('users', 'users._id', '=', 'blethers.user_id')
            ->where('user_id', '=', $user->_id);
        $feeds = DB::table('blethers')
            ->select('blethers._id','blethers.user_id','blethers.hasImage', 'blethers.subject', 'blethers.image AS bletherImage','blethers.updated_at','users.firstname', 'users.lastname', 'users.image AS userImage')
            ->join('users', 'users._id', '=', 'blethers.user_id')
            ->join('user_friends', function($join) use ($user)
            {
                $join->on('blethers.user_id', '=', 'user_friends.friend_id')
                    ->where('user_friends.user_id', '=', $user->_id)
                    ->orWhere('user_friends.friend_id', '=', $user->_id);
            })->union($blethers)->orderBy('updated_at', 'DESC')->get();
        foreach ($feeds as $feed){

            $feed->tags = Blether::find($feed->_id)->tags;
            $feed->comments = Blether::find($feed->_id)->comments;
            $feed->comments->each(function ($comment) {
                $comment->user = Comment::find($comment->_id)->user;

            });
        }


//TODO: return by latest date
        return ApiResponse::json(array(
            'input' => Input::all(),
            'user' => $user,
            'blethers' => $friendships,
            'feed' => $feeds
        ));
//        return ApiResponse::json(array('user' => $input->toArray()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return ApiResponse
     */
    public function store()
    {
        $user = Token::userFor(Input::get('token'));

        $blether = new Blether(array('subject' => Input::get('subject')));
        $blether->save();
        $user->blethers()->attach($blether);

        return ApiResponse::json(array('success' => true, 'input' => Input::all()));
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