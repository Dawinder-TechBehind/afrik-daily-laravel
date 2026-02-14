<?php

namespace App\Interfaces\Admin;
use Illuminate\Http\Request;

interface UserInterface
{
   public function listUsersBySearchAndPaginate( Request $request );
}
