<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\UsersLoginRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class UserController
 * @package App\Http\Controllers\Admin
 */
class UserController extends Controller
{
    /**
     * @var
     */
    protected $users;

    /**
     * UserController constructor.
     * @param $users
     */
    public function __construct(UsersLoginRepository $users)
    {
        $this->users = $users;
    }
}
