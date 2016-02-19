<?php
/**
 * Created by PhpStorm.
 * User: nicholas
 * Date: 16-2-20
 * Time: 上午2:39
 */

namespace AGarage\V1\Common\Models;


use Psr\Http\Message\ResponseInterface;

class APIResponse
{
    public $code = 0;
    public $data;

    public function setData($data) {
        $this->data = $data;
    }

    public function setCode($code) {
        $this->code = $code;
    }

    public function inject(ResponseInterface $response) {
        $response->getBody()->write(json_encode($this));
        return $response;
    }
}