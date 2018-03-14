<?php
/**
 * Created by PhpStorm.
 * User: master-d
 * Date: 11/01/15
 * Time: 17:35
 */

class Friend extends SmartLoquent
{

    protected $table = 'user_friends';
    protected $fillable = array('friend_id');


    // each blether BELONGS to many users
    // define our pivot table also
    public function users() {
        return $this->belongsToMany('User');
    }

    public function blethers() {
        return $this->hasManyThrough('Blether', 'User');
    }

}