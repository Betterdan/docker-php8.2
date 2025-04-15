<?php

namespace App\Controller;

use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Hyperf\HttpServer\Contract\RequestInterface;

#[Controller]
class AccountController
{
    #[RequestMapping(path: "index", methods: "get,post")]
    public function index(RequestInterface $request)
    {
        $id = $request->input("id");
        return ['id' => $id];
    }
}