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
 * AGarage\AccessLog
 *
 * @property integer $id
 * @property string $client_ip
 * @property string $user_agent
 * @property string $resource
 * @property float $exec_time
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\AGarage\AccessLog whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\AccessLog whereClientIp($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\AccessLog whereUserAgent($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\AccessLog whereResource($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\AccessLog whereExecTime($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\AccessLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\AccessLog whereUpdatedAt($value)
 */
	class AccessLog extends \Eloquent {}
}

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
 * AGarage\GuestbookMessage
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $content
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \AGarage\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\AGarage\GuestbookReply[] $replies
 * @method static \Illuminate\Database\Query\Builder|\AGarage\GuestbookMessage whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\GuestbookMessage whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\GuestbookMessage whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\GuestbookMessage whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\GuestbookMessage whereUpdatedAt($value)
 */
	class GuestbookMessage extends \Eloquent {}
}

namespace AGarage{
/**
 * AGarage\GuestbookReply
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $message_id
 * @property integer $parent_id
 * @property string $content
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \AGarage\User $user
 * @property-read \AGarage\GuestbookMessage $message
 * @property-read \AGarage\GuestbookReply $parent
 * @method static \Illuminate\Database\Query\Builder|\AGarage\GuestbookReply whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\GuestbookReply whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\GuestbookReply whereMessageId($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\GuestbookReply whereParentId($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\GuestbookReply whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\GuestbookReply whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\GuestbookReply whereUpdatedAt($value)
 */
	class GuestbookReply extends \Eloquent {}
}

namespace AGarage{
/**
 * AGarage\Permission
 *
 * @property integer $id
 * @property string $name
 * @property string $display_name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\AGarage\Role[] $roles
 * @method static \Illuminate\Database\Query\Builder|\AGarage\Permission whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\Permission whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\Permission whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\Permission whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\Permission whereUpdatedAt($value)
 */
	class Permission extends \Eloquent {}
}

namespace AGarage{
/**
 * AGarage\Role
 *
 * @property integer $id
 * @property string $name
 * @property string $display_name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\AGarage\User[] $users
 * @property-read \Illuminate\Database\Eloquent\Collection|\AGarage\Permission[] $perms
 * @method static \Illuminate\Database\Query\Builder|\AGarage\Role whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\Role whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\Role whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\Role whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\Role whereUpdatedAt($value)
 */
	class Role extends \Eloquent {}
}

namespace AGarage{
/**
 * AGarage\SocialiteUser
 *
 * @property string $id
 * @property string $driver
 * @property integer $user_id
 * @property string $token
 * @property string $secret
 * @property string $name
 * @property string $nickname
 * @property string $email
 * @property string $avatar
 * @property string $raw
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \AGarage\User $user
 * @method static \Illuminate\Database\Query\Builder|\AGarage\SocialiteUser whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\SocialiteUser whereDriver($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\SocialiteUser whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\SocialiteUser whereToken($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\SocialiteUser whereSecret($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\SocialiteUser whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\SocialiteUser whereNickname($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\SocialiteUser whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\SocialiteUser whereAvatar($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\SocialiteUser whereRaw($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\SocialiteUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\SocialiteUser whereUpdatedAt($value)
 */
	class SocialiteUser extends \Eloquent {}
}

namespace AGarage{
/**
 * AGarage\User
 *
 * @property integer $id
 * @property string $nickname
 * @property string $name
 * @property string $avatar
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \AGarage\SocialiteUser $socialite
 * @property-read \Illuminate\Database\Eloquent\Collection|\AGarage\Role[] $roles
 * @method static \Illuminate\Database\Query\Builder|\AGarage\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\User whereNickname($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\User whereAvatar($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\AGarage\User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

