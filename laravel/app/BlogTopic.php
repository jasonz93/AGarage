<?php

namespace AGarage;

use Illuminate\Database\Eloquent\Model;

class BlogTopic extends Model
{
    public function articles() {
        return $this->belongsToMany('AGarage\BlogArticle');
    }
}
