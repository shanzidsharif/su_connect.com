<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\Lecturer;
use Illuminate\Http\Request;
use DB;
use App\Models\User;

class LecturerController extends Controller
{
    public function adminLecturerList()
    {
        $list = DB::table('lecturers')
            ->select('lecturers.*')
            ->orderBy('status', 'desc')
            ->paginate(5);
        $user = User::where('user_type', 2)
            ->get();

        return view('admin.lecturer.list',[
            'list' => $list,
            'user' => $user,
        ]);
    }

    public function add()
    {
        $department = ClassModel::where('status', 1)->get();
        return view('admin.lecturer.add',[
            'departments' => $department,
        ]);
    }

    public function insert(Request $request)
    {
        $request->validate([
            'lecturer_id' => 'required',
            'mobile' => 'required',
            'email' => 'required|unique:lecturers,email',
        ]);
        $lecturer = Lecturer::insert($request);
        if(!empty($lecturer))
        {
            return redirect('admin/lecturer/list')->with('success', 'New Lecturer added successfully');
        }
        else
        {
            return redirect('admin/lecturer/list')->with('error', 'Duplicate Entry or Something Wrong!!');
        }
    }
    public function details($id)
    {
        $detail = Lecturer::findOrFail($id);
        $year = DB::table('lecturers')
            ->leftJoin('class_models', 'class_models.id', '=', 'lecturers.department')
            ->select('lecturers.*', 'class_models.year as year','class_models.department as class')
            ->where('class_models.id', $detail->department)
            ->first();
        return view('admin.lecturer.detail',[
            'detail' => $detail,
            'year' => $year,
        ]);
    }

    public function edit($id)
    {
        $edit = Lecturer::findOrFail($id);
        $departments = ClassModel::where('status', 1)->get();
        $year = DB::table('Lecturers')
            ->leftJoin('class_models', 'class_models.id', '=', 'lecturers.department')
            ->select('lecturers.*', 'class_models.year as year')
            ->where('class_models.id', $edit->department)
            ->first();
        return view('admin.Lecturer.edit',[
            'edit' => $edit,
            'year' => $year,
            'departments' => $departments,
        ]);
    }
    public function update(Request $request)
    {

//        $student = Student::findOrFail($request->id);
//
        $update = Lecturer::updateLecturer($request);
        if(!empty($update))
        {
            return redirect('admin/lecturer/list')->with('success', 'Lecturer Updated successfully');
        }
        else
        {
            return redirect('admin/lecturer/list')->with('error', 'Duplicate Entry or Something Wrong!!');
        }

    }

    public function status($id)
    {
        $status = Lecturer::find($id);
        $statusUser = User::where('email', $status->email)->first();
        if($status->status == 0)
        {
            $status->status = 1;
            $statusUser->status = 1;
        }
        elseif($status->status == 1)
        {
            $status->status = 0;
            $statusUser->status = 0;
        }
        $status->save();
        $statusUser->save();
        return redirect()->back();
    }

    public function delete($id)
    {
        $user = Lecturer::where('id', $id)->first();
        $userModel = User::where('email', $user->email)->first();
        if(file_exists('image'))
        {
            unlink($user->image);
        }
        $user->delete();
        $userModel->delete();
        return redirect('admin/lecturer/list')->with('info', 'Listed Lecturer Deleted Successfully');
    }


    public function search(Request $request)
    {
        $output = "";

        $list=   DB::table('Lecturers')
            ->select('Lecturers.*')
            ->where('email','like','%'.$request->search.'%')
            ->orWhere('lecturer_id','like','%'.$request->search.'%')
            ->orWhere('first_name','like','%'.$request->search.'%')
            ->orWhere('last_name','like','%'.$request->search.'%')
            ->orWhere('mobile','like','%'.$request->search.'%')
            ->orWhere('nid','like','%'.$request->search.'%')
            ->orWhere('joining_date','like','%'.$request->search.'%')
            ->orWhere('date_of_birth','like','%'.$request->search.'%')
            ->paginate(3);

        $sl = 1;
        foreach ($list as $item)
        {
            $output.=
                '<tr>
                    <td>
                        '.$sl++.'
                    </td>
                    <td>
                        '.' <img src="asset'.$item->image.'" alt="" height="30px"  class="rounded-circle widget-user">'.'
                    </td>
                    <td>
                        '.$item->first_name.'  '.$item->last_name.'
                    </td>
                    <td>
                        '.$item->email.'
                    </td>
                    <td>
                        '.$item->mobile.'
                    </td>

                    <td>
                        '.$item->joining_date.'
                    </td>
                     <td>
                         '.
                ($item->status == 1 ? ' <a href="/project/su_connect.com/admin/lecturer/list-status/'.$item->id.'" class="btn btn-sm btn-success">'.'Active</a>' : ($item->status == 0 ? ' <a href="/project/su_connect.com/admin/lecturer/list-status/'.$item->id.'" class="btn btn-sm btn-primary">'.'Inactive</a>' : ''))

                .'

                    </td>
                    <td>
                        '.'
                            <a href="/project/su_connect.com/admin/lecturer/list-details/'.$item->id.'" class="btn btn-sm btn-info">Details</a>
                        '.'
                        '.'
                            <a href="/project/su_connect.com/admin/lecturer/list-edit/'.$item->id.'" class="btn btn-sm btn-success">Edit</a>
                        '.'
                         '.'
                            <a href="/project/su_connect.com/admin/lecturer/list-delete/'.$item->id.'" class="btn btn-sm btn-danger">Delete</a>
                        '.'

                    </td>

                </tr>';
        }
        return response()->json($output);
    }
}
