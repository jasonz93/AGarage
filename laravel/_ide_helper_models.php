<?php
/**
 * An helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace AGarage{
/**
 * AGarage\BlogArticle
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\AGarage\BlogTopic[] $topics
 * @property-read \Illuminate\Database\Eloquent\Collection|\AGarage\BlogComment[] $comments
 * @method static \Illuminate\Database\Query\Builder|\AGarage\BlogArticle whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\BlogArticle whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\BlogArticle whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\BlogArticle whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\BlogArticle whereUpdatedAt($value)
 */
	class BlogArticle extends \Eloquent {}
}

namespace AGarage{
/**
 * AGarage\User
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\AGarage\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace AGarage{
/**
 * AGarage\BlogTopic
 *
 * @property integer $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\AGarage\BlogArticle[] $articles
 * @method static \Illuminate\Database\Query\Builder|\AGarage\BlogTopic whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\BlogTopic whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\BlogTopic whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\BlogTopic whereUpdatedAt($value)
 */
	class BlogTopic extends \Eloquent {}
}

namespace AGarage{
/**
 * AGarage\BlogComment
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \AGarage\BlogArticle $article
 * @property-read \AGarage\BlogComment $parent
 * @property-read \Illuminate\Database\Eloquent\Collection|\AGarage\BlogComment[] $follows
 * @method static \Illuminate\Database\Query\Builder|\AGarage\BlogComment whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\BlogComment whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\BlogComment whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\BlogComment whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\BlogComment whereUpdatedAt($value)
 */
	class BlogComment extends \Eloquent {}
}

