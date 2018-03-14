<?php
/**
 * Created by PhpStorm.
 * User: master-d
 * Date: 12/01/15
 * Time: 22:37
 */
class Tag extends Eloquent{
    protected $fillable = array('tag', 'tagFriendly');

    public function blethers(){
        return $this->belongsToMany('Blether', 'blether_tags')->withTimestamps();

    }

}