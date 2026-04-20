<?php 
namespace App\Repositories\Admin;

use App\Interfaces\Admin\UserInterface;
use Illuminate\Http\Request;
use App\Models\User;

class UserRepository implements UserInterface
{ 
    
    public function listUsersBySearchAndPaginate( Request $request ){
        $query = User::withoutRole('admin')->with(['roles', 'kycDetail'])->orderByDesc('id');
        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $data['users'] = $query->paginate(21);
        $data['code'] = 200;
        return $data;
    }


 
}

?>