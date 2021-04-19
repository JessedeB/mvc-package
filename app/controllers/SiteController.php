<?php

namespace App\Controllers;

use App\Core\Request;

class SiteController extends BaseController
{
    public function users()
    {
        $data = [
          'title' => 'Users page'
        ];

        return $this->view('users', $data);
    }

    public function handle(Request $request)
    {

        $body = $request->validate();

        var_dump($body);


    }

}