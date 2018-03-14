<?php
/**
 * Created by PhpStorm.
 * User: master-d
 * Date: 06/12/14
 * Time: 01:20
 */

class Comment extends SmartLoquent {
    protected $fillable = array('content');

    public function blether()
    {
        return $this->belongsTo('Blether');
    }
    public function user()
    {
        return $this->belongsTo('User');
    }
} 