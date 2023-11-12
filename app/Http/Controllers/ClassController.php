<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use Auth;

class ClassController extends Controller
{
    public function classList()
    {
        $list = ClassModel::getClassData();
        return view('admin.class.list', [
            'list' => $list,
        ]);
    }
    public function add()
    {
        return view('admin.class.add');
    }

    public function insert(Request $request)
    {
        $request->validate([
            'department' => 'required',
            'year'=> 'required',
        ]);
        $class = ClassModel::insert($request);
        if(!empty($class))
        {
            return redirect('admin/class/list')->with('success', 'New Department added successfully');
        }
        else
        {
            return redirect('admin/class/list')->with('error', 'Duplicate Entry or Something Wrong!!');

        }

    }

    public function edit($id)
    {
        $class = ClassModel::where('id', $id)->first();

        return view('admin.class.edit',[
            'list' => $class,
        ]);
    }
    public function update(Request $request)
    {
//         return $request->all();
        $class = ClassModel::updateClass($request);
        if(!empty($class))
        {
            return redirect('admin/class/list')->with('success', 'Department Updated Successfully');
        }
        else
        {
            return redirect('admin/class/list')->with('error', 'Duplicate Entry or Something Wrong!!');
        }

    }

    public function status($id)
    {
        $status = ClassModel::find($id);
        if($status->status == 0)
        {
            $status->status = 1;
        }
        elseif($status->status == 1)
        {
            $status->status = 0;
        }
        $status->save();
        return redirect()->back();
    }

    public function delete($id)
    {
        $user = ClassModel::where('id', $id)->first();
        $user->delete();
        return redirect('admin/class/list')->with('info', 'Department Deleted Successfully');
    }

    public function search(Request $request)
    {
        $output = "";
        $list = ClassModel::where('department','like','%'.$request->search.'%')
            ->orWhere('status','like','%'.$request->search.'%')
            ->orWhere('year','like','%'.$request->search.'%')
            ->orWhere('created_at','like','%'.$request->search.'%')
            ->get();

        $sl = 1;
        foreach ($list as $item)
        {
            $output.=
                '<tr>
                    <td>
                        '.$sl++.'
                    </td>
                    <td>
                        '.$item->department.'
                    </td>
                    <td>
                    '.
                        ($item->year == 1 ? 'One' : ($item->year == 3 ? 'Three' : ($item->year == 4 ? 'Four' : '')))
                    .'
                    </td>

                    <td>
                        '.$item->created_at.'
                    </td>

                    <td>
                         '.
                            ($item->status == 1 ? ' <a href="/project/su_connect.com/admin/class/list-status/'.$item->id.'" class="btn btn-sm btn-success">'.'Active</a>' : ($item->status == 0 ? ' <a href="/project/su_connect.com/admin/class/list-status/'.$item->id.'" class="btn btn-sm btn-primary">'.'Inactive</a>' : ''))
                        .'

                    </td>
                    <td>
                        '.'
                            <a href="/project/su_connect.com/admin/class/list-edit/'.$item->id.'" class="btn btn-sm btn-success">Edit</a>
                        '.'
                         '.'
                            <a href="/project/su_connect.com/admin/class/list-delete/'.$item->id.'" class="btn btn-sm btn-danger">Delete</a>
                        '.'

                    </td>

                </tr>';
        }
        return response()->json($output);
    }

}
