<?php
/**
 * Created by PhpStorm.
 * User: Nicholas
 * Date: 2016/3/10
 * Time: 0:59
 */

namespace AGarage\Socialite;


use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\ProviderInterface;
use Laravel\Socialite\Two\User;

class WeiboProvider extends AbstractProvider implements ProviderInterface
{

    protected $scopes = ['email'];

    /**
     * Get the authentication URL for the provider.
     *
     * @param  string $state
     * @return string
     */
    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase('https://api.weibo.com/oauth2/authorize', $state);
    }

    /**
     * Get the token URL for the provider.
     *
     * @return string
     */
    protected function getTokenUrl()
    {
        return 'https://api.weibo.com/oauth2/access_token';
    }

    /**
     * Get the raw user for the given access token.
     *
     * @param  string $token
     * @return array
     */
    protected function getUserByToken($token)
    {
        //https://api.weibo.com/oauth2/get_token_info
        $uid = $this->getUidByToken($token);

        $userUrl = "https://api.weibo.com/2/account/get_uid.json?access_token=$token&uid=$uid";
        $response = $this->getHttpClient()->get($userUrl);

        $user = json_decode($response->getBody(), true);


//        $user['email'] = $this->getEmailByToken($token);

        return $user;

        //https://api.weibo.com/2/users/show.json
    }

    protected function getUidByToken($token) {
        $uidUrl = 'https://api.weibo.com/2/account/get_uid.json?access_token='.$token;
        $response = $this->getHttpClient()->get($uidUrl);

        $json = json_decode($response->getBody(), true);

        return $json['uid'];
    }

    protected function getEmailByToken($token) {
        $emailUrl = 'https://api.weibo.com/2/account/profile/email.json?access_token='.$token;
        $response = $this->getHttpClient()->get($emailUrl);
        $email = json_decode($response->getBody(), true);
        return $email['email'];
    }

    /**
     * Map the raw user array to a Socialite User instance.
     *
     * @param  array $user
     * @return \Laravel\Socialite\User
     */
    protected function mapUserToObject(array $user)
    {
        return (new User())->setRaw($user)
            ->map([
                'id' => strval($user['id']),
                'nickname' => $user['screen_name'],
                'name' => $user['name'],
//                'email' => $user['email'],
                'avatar' => $user['avatar_large']
            ]);
    }
}