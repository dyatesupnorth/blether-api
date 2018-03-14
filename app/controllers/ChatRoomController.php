<?php

class ChatRoomController extends \BaseController
{

    /**
     * @param ChatRoom $chatRooms
     */
    public function __construct()
    {
        $this->beforeFilter('logged_in');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {

        $user = Token::userFor(Input::get('token'));
        $chatRooms = ChatRoom::where('user_id', $user->_id)->get();
        $chatRooms->each(function ($chatRoom) {
            $chatRoom->friendInfo = User::find($chatRoom->friend_id);
        });

        return ApiResponse::json(array(
            'input' => Input::all(),
            'user' => $user,
            'chatRooms' => $chatRooms
        ));
    }


    /**
     * @param ChatRoom $chatRoom
     * @return ChatRoom
     */
    public function show(ChatRoom $chatRoom)
    {
        return $chatRoom;
    }


    /**
     * @return static
     */
    public function create()
    {

        $user = User::find(Input::get('user_id'));
        $friend = User::find(Input::get('friend_id'));

        $existingChatsByUser = ChatRoom::where('user_id', '=', $user->_id)
            ->where('friend_id', '=', $friend->_id)
            ->first();
        $existingChatsByFriend = ChatRoom::where('user_id', '=', $friend->_id)
            ->where('friend_id', '=', $user->_id)
            ->first();

        if (!is_null($existingChatsByUser) || !is_null($existingChatsByFriend)  ) {
            return ApiResponse::json(array(
                'Chat Room already exists',
                'input' => Input::all(),
                'user' => $user,
                'friend' => $friend,
                'chatRoomsbyUser' => $existingChatsByUser,
                'chatRoomsbyFriend' => $existingChatsByFriend
            ));
        } else {
            ChatRoom::create(array(
                'user_id' => Input::get('user_id'),
                'friend_id' => Input::get('friend_id')
            ));
            return ApiResponse::json(array(
                'Created a new chat room',
                'input' => Input::all(),
                'user' => $user,
                'friend' => $friend,
                'chatRooms' => $existingChats
            ));
        }


    }


}
