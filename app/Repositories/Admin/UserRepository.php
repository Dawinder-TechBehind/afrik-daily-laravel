<?php 
namespace App\Repositories\Admin;

use App\Interfaces\Admin\UserInterface;
use Illuminate\Http\Request;
use App\Models\User;

class UserRepository implements UserInterface
{ 
    
    public function listUsersBySearchAndPaginate( Request $request ){
        $data['users'] = User::withoutRole('admin')
                                ->orderByRaw('id desc')
                                ->paginate(21);
        $data['code'] = 200;
        return $data;
    }


 
}

?>