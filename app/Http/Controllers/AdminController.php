<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;

class AdminController extends Controller
{
    public function adminList()
    {

        $list = User::select('users.*')->where('user_type', 1)->orderBy('id', 'desc')->paginate(6);
        return view('admin.admin.list',[
            'list' => $list,
        ]);
    }

    public function addAdmin()
    {
        return view('admin.admin.add');
    }

    public function postAddAdmin(Request $request)
    {
        $request->validate([
           'name' => 'required',
           'email' => 'required|unique:users,email',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->user_type = 1;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect('admin/list')->with('success', 'New Admin added successfully');
    }
    public function adminEdit($id)
    {
        $user = User::findorFail($id);
        return view('admin.admin.edit', [
            'user' => $user,
        ]);
    }
    public function updateAdmin($id, Request $request)
    {
        $request->validate([
           'name'   => 'required',
            'email' => 'required|unique:users,email,'.$id,
        ]);
        $user = User::findorFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->user_type = 1;
        if(!empty($request->password))
        {
            $user->password = Hash::make($request->password);
        }
        $user->password =  $user->password;
        $user->save();
        return redirect('admin/list')->with('success', 'Admin edited Successfully');
    }
    public function adminDelete($id)
    {
        $user = User::where('id', $id)->first();
        $user->delete();
        return redirect('admin/list')->with('success', 'Admin Deleted Successfully');
    }

    public function search(Request $request)
    {
        $output = "";
        $list = User::where('name','like','%'.$request->search.'%')
            ->where('user_type', 1)
            ->orWhere('email','like','%'.$request->search.'%')
            ->where('user_type', 1)
            ->get();

        $sl = 1;
        foreach ($list as $item)
        {
            $output.=
                '<tr>
                    <td>
                        '.$item->id.'
                    </td>
                    <td>
                        '.$item->name.'
                    </td>
                    <td>
                        '.$item->email.'
                    </td>
                    <td>
                        '.$item->created_at.'
                    </td>
                    <td>
                        '.'
                            <a href="/project/su_connect.com/admin/list-edit/'.$item->id.'" class="btn btn-sm btn-success">Edit</a>
                        '.'
                         '.'
                            <a href="/project/su_connect.com/admin/list-delete/'.$item->id.'" class="btn btn-sm btn-danger">Delete</a>
                        '.'

                    </td>

                </tr>';
        }
        return response()->json($output);
    }
}
