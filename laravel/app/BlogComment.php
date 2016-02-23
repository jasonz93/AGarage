<?php

namespace AGarage;

use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    public function article() {
        return $this->belongsTo('AGarage\BlogArticle');
    }

    public function parent() {
        return $this->belongsTo('AGarage\BlogComment');
    }

    public function follows() {
        return $this->hasMany('AGarage\BlogComment');
    }
}
