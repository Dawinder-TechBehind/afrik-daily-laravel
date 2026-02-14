<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Interfaces\Admin\UserInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userInterface;
    public function __construct(UserInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }

    public function list( Request $request ){
        $result = $this->userInterface->listUsersBySearchAndPaginate( $request );
        // dd($result);
        return view( 'admin.users.index' , $result );
    }
}
