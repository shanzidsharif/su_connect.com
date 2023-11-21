<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use DB;

class StudentController extends Controller
{
    public function adminStudentList()
    {
    $list = DB::table('students')
            ->leftJoin('class_models', 'class_models.id', '=', 'students.department')
            ->select('students.*', 'class_models.year as year', 'class_models.department as class')
            ->where('class_models.status', 1)
            ->paginate(5);

        return view('admin.student.list',[
            'list' => $list,
        ]);
    }

    public function add()
    {
        $department = ClassModel::where('status', 1)->get();
        return view('admin.student.add',[
            'departments' => $department,
        ]);
    }

    public function insert(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'department' => 'required',
            'email' => 'required|unique:users,email',
        ]);
        $student = Student::insert($request);
        if(!empty($student))
        {
            return redirect('admin/student/list')->with('success', 'New Student added successfully');
        }
        else
        {
            return redirect('admin/student/list')->with('error', 'Duplicate Entry or Something Wrong!!');
        }
    }
    public function details($id)
    {
        $detail = Student::findOrFail($id);
        $year = DB::table('students')
            ->leftJoin('class_models', 'class_models.id', '=', 'students.department')
            ->select('students.*', 'class_models.year as year','class_models.department as class')
            ->where('class_models.id', $detail->department)
            ->first();
        return view('admin.student.detail',[
            'detail' => $detail,
            'year' => $year,
        ]);
    }

    public function edit($id)
    {
        $edit = Student::findOrFail($id);
        $departments = ClassModel::where('status', 1)->get();
        $year = DB::table('students')
            ->leftJoin('class_models', 'class_models.id', '=', 'students.department')
            ->select('students.*', 'class_models.year as year')
            ->where('class_models.id', $edit->department)
            ->first();
        return view('admin.student.edit',[
            'edit' => $edit,
            'year' => $year,
            'departments' => $departments,
        ]);
    }
    public function update(Request $request)
    {

//        $student = Student::findOrFail($request->id);
//
        $update = Student::updateStudent($request);
        if(!empty($update))
        {
            return redirect('admin/student/list')->with('success', 'Student Updated successfully');
        }
        else
        {
            return redirect('admin/student/list')->with('error', 'Duplicate Entry or Something Wrong!!');
        }

    }

    public function status($id)
    {
        $status = Student::find($id);
        $user = User::where('email', $status->email)->first();
        if($status->status == 0)
        {
            $status->status = 1;
            $user->status = 1;
        }
        elseif($status->status == 1)
        {
            $status->status = 0;
            $user->status = 0;
        }
        $status->save();
        $user->save();
        return redirect()->back();
    }

    public function delete($id)
    {
        $user = Student::where('id', $id)->first();
        $singleUser = User::where('email', $user->email)->first();

        if(file_exists('image'))
        {
            unlink($user->image);
        }
        $user->delete();
        $singleUser->delete();
        return redirect('admin/student/list')->with('info', 'Listed Student Deleted Successfully');
    }


             public function search(Request $request)
    {
        $output = "";

        $list=   DB::table('students')
            ->leftJoin('class_models', 'class_models.id', '=', 'students.department')
            ->select('students.*', 'class_models.year as year', 'class_models.department as class')
            ->where('class_models.department','like','%'.$request->search.'%')
            ->orWhere('class_models.year','like','%'.$request->search.'%')
            ->orWhere('first_name','like','%'.$request->search.'%')
            ->orWhere('student_id','like','%'.$request->search.'%')
            ->orWhere('mobile','like','%'.$request->search.'%')
            ->orWhere('nid','like','%'.$request->search.'%')
            ->orWhere('email','like','%'.$request->search.'%')
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
                        '.$item->first_name.'. '.' '.'.'.$item->first_name.'
                    </td>
                    <td>
                        '.$item->email.'
                    </td>
                    <td>
                        '.$item->mobile.'
                    </td>
                    <td>
                        '.$item->class.' '.'-'.'
                        '.
                         ($item->year == 1 ? 'One' : ($item->year == 3 ? 'Three' : ($item->year == 4 ? 'Four' : '')))
                        .'
                    </td>
                    <td>
                        '.$item->nid.'
                    </td>
                     <td>
                         '.
                ($item->status == 1 ? ' <a href="/project/su_connect.com/admin/student/list-status/'.$item->id.'" class="btn btn-sm btn-success">'.'Active</a>' : ($item->status == 0 ? ' <a href="/project/su_connect.com/admin/student/list-status/'.$item->id.'" class="btn btn-sm btn-primary">'.'Inactive</a>' : ''))

                .'

                    </td>
                    <td>
                        '.'
                            <a href="/project/su_connect.com/admin/student/list-details/'.$item->id.'" class="btn btn-sm btn-info">Details</a>
                        '.'
                        '.'
                            <a href="/project/su_connect.com/admin/student/list-edit/'.$item->id.'" class="btn btn-sm btn-success">Edit</a>
                        '.'
                         '.'
                            <a href="/project/su_connect.com/admin/student/list-delete/'.$item->id.'" class="btn btn-sm btn-danger">Delete</a>
                        '.'

                    </td>

                </tr>';
        }
        return response()->json($output);
    }
}
