<?php

namespace App\Http\Controllers;

use App\Models\SubjectModel;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function subjectList()
    {
        $list = SubjectModel::getSubjectData();
        return view('admin.subject.list', [
            'list' => $list,
        ]);
    }
    public function add()
    {
        return view('admin.subject.add');
    }

    public function insert(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'code'=> 'required|unique:subject_models,code',
            'subject_type'=> 'required',
        ]);
        $subject = SubjectModel::insert($request);
        if(!empty($subject))
        {
            return redirect('admin/subject/list')->with('success', 'New Subject added successfully');
        }
        else
        {
            return redirect('admin/subject/list')->with('error', 'Duplicate Entry or Something Wrong!!');

        }

    }
    public function edit($id)
    {
        $subject = SubjectModel::where('id', $id)->first();

        return view('admin.subject.edit',[
            'list' => $subject,
        ]);
    }

    public function update(Request $request)
    {
//         return $request->all();
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'subject_type'=> 'required',
        ]);
        $subject = SubjectModel::updateSubject($request);
        if(!empty($subject))
        {
            return redirect('admin/subject/list')->with('success', 'Subject Updated Successfully');
        }
        else
        {
            return redirect('admin/subject/list')->with('error', 'Duplicate Entry or Something Wrong!!');
        }

    }

    public function delete($id)
    {
        $user = SubjectModel::where('id', $id)->first();
        $user->delete();
        return redirect('admin/subject/list')->with('info', 'Subject Deleted Successfully');
    }
    public function search(Request $request)
    {
        $output = "";
        $list = SubjectModel::where('name','like','%'.$request->search.'%')
            ->orWhere('code','like','%'.$request->search.'%')
            ->orWhere('subject_type','like','%'.$request->search.'%')
            ->orWhere('status','like','%'.$request->search.'%')
            ->orderBy('name', 'asc')
            ->paginate(5);

        $sl = 1;
        foreach ($list as $item)
        {
            $output.=
                '<tr>
                    <td>
                        '.$sl++.'
                    </td>
                    <td>
                        '.$item->name.'
                    </td>
                    <td>
                        '.$item->code.'
                    </td>
                    <td>
                    '.
                        ($item->subject_type == 1 ? 'Theory' : ($item->subject_type == 2 ? 'LAB' : ''))
                     .'
                    </td>

                    <td>
                         '.
                            ($item->status == 1 ? "Active" : ($item->status == 0 ?  'Inactive' : ''))
                         .'

                    </td>
                    <td>
                        '.'
                            <a href="/project/su_connect.com/admin/subject/list-edit/'.$item->id.'" class="btn btn-sm btn-success">Edit</a>
                        '.'
                         '.'
                            <a href="/project/su_connect.com/admin/subject/list-delete/'.$item->id.'" class="btn btn-sm btn-danger">Delete</a>
                        '.'

                    </td>

                </tr>';
        }
        return response()->json($output);
    }

}
