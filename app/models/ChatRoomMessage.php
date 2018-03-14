<?php
/**
 * Created by PhpStorm.
 * User: master-d
 * Date: 22/01/15
 * Time: 20:53
 */

class ChatRoomMessage extends SmartLoquent {

    /**
     * @var string
     */
    protected $table = 'chat_room_messages';

    /**
     * @var array
     */
    protected $fillable = array('content');

    /**
     * @var array
     */
    protected $with = array('user');

    /**
     * @param $query
     * @param $lastId
     * @return mixed
     */
    public function scopeAfterId($query, $lastId)
    {
        return $query->where('_id', '>', $lastId);
    }

    /**
     * @param $query
     * @param $chatRoom
     * @return mixed
     */
    public function scopeByChatRoom($query, $chatRoom)
    {
        return $query->where('_id', $chatRoom->id);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function chatRoom()
    {
        return $this->belongsTo('ChatRoom', 'chat_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('User', 'user_id');
    }
}