<?php
/**
 * Created by PhpStorm.
 * User: master-d
 * Date: 22/01/15
 * Time: 20:52
 */

class ChatRoom extends SmartLoquent {

    /**
     * @var string
     */
    protected $table = 'chat_rooms';

    /**
     * @var array
     */
    protected $fillable = array('user_id','friend_id');

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany('ChatRoomMessage', 'chat_id');
    }
}