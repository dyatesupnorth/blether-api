<?php

class ChatRoomMessageController extends \BaseController {

    /**
     * @param ChatRoomMessage $messages
     *
     */
    public function __construct(ChatRoomMessage $messages)
    {
        $this->beforeFilter('logged_in');
        $this->messages = $messages;
    }

    /**
     * @param ChatRoom $chatRoom
     * @return mixed
     */
    public function getByChatRoom(ChatRoom $chatRoom)
    {
        return ApiResponse::json(array(
            'input' => Input::all(),
            'messages' => $chatRoom->messages
        ));
    }

    /**
     * @param ChatRoom $chatRoom
     * @return static
     */
    public function createInChatRoom(ChatRoom $chatRoom)
    {

        $user = Token::userFor(Input::get('token'));

        $message = new ChatRoomMessage(array(
            'user_id' => $user->_id,
            'chat_id' => Input::get('_id'),
            'content' => Input::get('newMessage')
        ));

        $message->chatRoom()->associate($chatRoom);
        $message->user()->associate($user);

        $message->save();

        return ApiResponse::json(array(
            'input' => Input::all(),
            'message' => $message,
            'chatroom' => $chatRoom
        ));
    }


    /**
     * @param $lastMessageId
     * @param ChatRoom $chatRoom
     * @return mixed
     */
    public function getUpdates($lastMessageId, ChatRoom $chatRoom)
    {

        return ApiResponse::json(array(
            'input' => Input::all(),
            'messages' => ChatRoomMessage::where('chat_id', $chatRoom->_id) // don't need the "="
            ->where('_id', '>', $lastMessageId)->get(),
            'chatroom' => $chatRoom
        ));
//        return $this->messages->byChatRoom($chatRoom)->afterId($lastMessageId)->get();
    }


}
