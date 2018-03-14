<?php

class Blether extends SmartLoquent
{
    protected $fillable = array('user_id','subject', 'hasImage', 'image');


    // each blether BELONGS to many users
    // define our pivot table also
    public function user() {
        return $this->belongsTo('User');
    }
    public function comments()
    {
        return $this->hasMany('Comment');
    }
    public function tags() {
        return $this->belongsToMany('Tag','blether_tags')->withTimestamps();
    }
}
