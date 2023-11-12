<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\ClassSubjectModel;
use App\Models\SubjectModel;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
use function Monolog\alert;

class ClassSubjectController extends Controller
{
    public function subjectList()
    {

        $assign_subject=   DB::table('class_subject_models')
            ->leftJoin('class_models', 'class_models.id', '=', 'class_subject_models.class_id')
            ->leftJoin('subject_models', 'subject_models.id', '=', 'class_subject_models.subject_id')
            ->leftJoin('users', 'users.id', '=', 'class_subject_models.assigned_by')
            ->select('class_subject_models.*' , 'users.name as user_name', 'class_models.department as class_name', 'subject_models.name as subject_name')
            ->where('class_models.status','=', 1)
            ->orderBy('status','desc')
            ->paginate(3);
        return view('admin.assign-subject.list', [
            'list' => $assign_subject,
        ]);
    }
    public function add()
    {
        $list['classes'] = ClassModel::where('status', 1)->get();
        $list['subjects'] = SubjectModel::where('status', 1)->get();
        $list['users'] = User::where('email', Auth::user()->email)->first();
        return view('admin.assign-subject.add', [
            'list' => $list,
        ]);
    }

    public function insert(Request $request)
    {
        $request->validate([
            'semester' => 'required',
            'class_id'=> 'required',
        ]);
        $assign_subject = ClassSubjectModel::insert($request);
        if(!empty($assign_subject))
        {
            return redirect('admin/subject-assign/list')->with('success', 'Assign Subject added successfully');
        }
        else
        {
            return redirect('admin/subject-assign/list')->with('error', 'Duplicate Entry or Something Wrong!!');

        }
    }

    public function edit($id)
    {
        $sub = ClassSubjectModel::where('id', $id)->first();
        $classes = ClassModel::all();
        $subjects = SubjectModel::all();
        $users = User::where('email', Auth::user()->email)->first();
        $assign_subject = DB::table('class_subject_models')
            ->leftJoin('class_models', 'class_models.id', 'class_subject_models.class_id')
            ->leftJoin('subject_models', 'subject_models.id', 'class_subject_models.subject_id')
            ->leftJoin('users', 'users.email', 'class_subject_models.assigned_by')
            ->select('class_subject_models.*' , 'users.name as user_name', 'class_models.department as class_name', 'subject_models.name as subject_name')
            ->where('class_id', $sub->class_id)
            ->where('semester', $sub->semester)
            ->pluck('subject_id')
            ->toArray();

        return view('admin.assign-subject.edit',[
           'sub' => $sub,
           'classes' => $classes,
           'subjects' => $subjects,
           'users' => $users,
           'assign_subject' => $assign_subject,
        ]);


    }
    public function update(Request $request)
    {
        $getId = ClassSubjectModel::find($request->id);
        if(!empty($getId))
        {
            $delete_assign_subject =   DB::table('class_subject_models')
                ->where('class_subject_models.class_id','=', $getId->class_id)
                ->where('class_subject_models.semester','=', $getId->semester)
                ->get();
            if(empty($delete_assign_subject))
            {
                return redirect('admin/subject-assign/list')->with('error', 'Something Wrong!! Please Try Again');
            }

            $assign_subject = ClassSubjectModel::updateAssignSubject($request);

        }
        else
        {
            $assign_subject = ClassSubjectModel::updateAssignSubject($request);
        }

        if(!empty($assign_subject))
        {
            return redirect('admin/subject-assign/list')->with('success', 'Assign Subject Updated Successfully');
        }
        else
        {
            return redirect('admin/subject-assign/list')->with('error', 'Something Wrong!! Please Try Again');

        }

//        $assign_subject=   DB::table('class_subject_models')
//            ->leftJoin('class_models', 'class_models.id', '=', 'class_subject_models.class_id')
//            ->leftJoin('subject_models', 'subject_models.id', '=', 'class_subject_models.subject_id')
//            ->leftJoin('users', 'users.id', '=', 'class_subject_models.assigned_by')
//            ->select('class_subject_models.*' , 'users.name as user_name', 'class_models.department as class_name', 'subject_models.name as subject_name')
//            ->where('class_models.status', 1)
//            ->where('subject_models.status', 1)
//            ->get();


    }

    public function status($id)
    {
        $status = ClassSubjectModel::find($id);
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
        $user = ClassSubjectModel::where('id', $id)->first();
        $user->delete();
        return redirect('admin/subject-assign/list')->with('info', 'Assign Subject Deleted Successfully');
    }

    public function search(Request $request)
    {

//
//        $list = DB::table('class_subject_models')
//            ->join('class_models', 'class_models.id', '=', 'class_subject_models.class_id')
//            ->join('subject_models', 'subject_models.id', '=', 'class_subject_models.subject_id')
//            ->select('class_subject_models.*', 'class_models.department as class_name',
//                'subject_models.name as subject_name', 'class_models.year as year')
//            ->where('class_name','like','%'.$request->search.'%')
//            ->orWhere('subject_name','like','%'.$request->search.'%')
//            ->orWhere('semester','like','%'.$request->search.'%')
//            ->orWhere('year','like','%'.$request->search.'%')
//            ->orWhere('assigned_by','like','%'.$request->search.'%')
//
//            ->paginate(5);
        $output = "";

        $list=   DB::table('class_subject_models')
            ->leftJoin('class_models', 'class_models.id', '=', 'class_subject_models.class_id')
            ->leftJoin('subject_models', 'subject_models.id', '=', 'class_subject_models.subject_id')
            ->leftJoin('users', 'users.id', '=', 'class_subject_models.assigned_by')
            ->select('class_subject_models.*')
            ->where('assigned_by','like','%'.$request->search.'%')
            ->orWhere('semester','like','%'.$request->search.'%')
            ->orWhere('class_models.department','like','%'.$request->search.'%')
            ->orWhere('subject_models.name','like','%'.$request->search.'%')
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
                        '.$item->class_name.'
                    </td>
                    <td>
                        '.$item->year.'
                    </td>
                    <td>
                        '.$item->semester.'
                    </td>
                    <td>
                        '.$item->subject_name.'
                    </td>
                    <td>
                        '.$item->assigned_by.'
                    </td>
                     <td>
                         '.
      ($item->status == 1 ? ' <a href="/project/su_connect.com/admin/subject-assign/list-status/'.$item->id.'" class="btn btn-sm btn-success">'.'Active</a>' : ($item->status == 0 ? ' <a href="/project/su_connect.com/admin/subject-assign/list-status/'.$item->id.'" class="btn btn-sm btn-primary">'.'Inactive</a>' : ''))

                        .'

                    </td>
                    <td>
                        '.'
                            <a href="/project/su_connect.com/admin/subject-assign/list-edit/'.$item->id.'" class="btn btn-sm btn-success">Edit</a>
                        '.'
                         '.'
                            <a href="/project/su_connect.com/admin/subject-assign/list-delete/'.$item->id.'" class="btn btn-sm btn-danger">Delete</a>
                        '.'

                    </td>

                </tr>';
        }
        return response()->json($output);
    }


}
