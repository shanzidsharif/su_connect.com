<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
      'email',
      'mobile',
      'first_name',
      'last_name',
        'email',
        'department',
    ];
    public static function insert($request)
    {
        $allStudents = Student::all();
        $userModel = User::all();
//        dd($request->all());
        $student = new Student();
        $student->first_name = $request->first_name;
        $student->last_name = $request->last_name;
        if (($allStudents->where('email', $request->email)->count() > 0) &&
                ($userModel->where('email', $request->email)->count() > 0))
        {
            return '';
        }
        else {
            $student->email = $request->email;
        }
        if (($allStudents->where('mobile', $request->mobile)->count() > 0))
        {
            return '';
        }
        else {
        $student->mobile = $request->mobile;
        }
        $student->password =Hash::make($request->email);
        if(!empty($request->alt_mobile))
        {
            $student->alt_mobile = $request->alt_mobile;
        }
        if(!empty($request->department))
        {
            $student->department  = $request->department;

        } if(!empty($request->religious))
        {
            $student->religious = $request->religious;
        }
        if(!empty($request->student_id))
        {
            $student->student_id = $request->student_id;
        }
        if(!empty($request->admission_date))
        {
            $student->admission_date   = $request->admission_date;
        }
        if(!empty($request->date_of_birth))
        {
            $student->date_of_birth   = $request->date_of_birth;
        }
        if(!empty($request->blood))
        {
            $student->blood    = $request->blood;
        }
        if(!empty($request->father_name))
        {
            $student->father_name    = $request->father_name;
        }

        (!empty($request->mother_name) ? $student->mother_name = $request->mother_name : '');
        (!empty($request->permanent_address) ? $student->permanent_address = $request->permanent_address : '');

        if(!empty($request->present_address))
        {
            $student->present_address   = $request->present_address;
        }
        if(!empty($request->nid))
        {
            $student->nid  = $request->nid;
        }
        if(!empty($request->status))
        {
            $student->status  = $request->status;
        }
        if(!empty($request->image))
        {
            $student->image  = self::getImageUrl($request);
        }
        $student->save();
        $user = new User();
        $user->name = $student->first_name. ' ' .$student->last_name;
        $user->email = $student->email;
        $user->password = $student->password;
        $user->user_type = 3;
        $user->status = $student->status;
        $user->save();
        $student->save();
//        dd($student);
       return $student;
    }
    public static function updateStudent($request)
    {
        $student = Student::findOrFail($request->id);
        $userModel = User::all();
        $allDepartment = ClassModel::pluck('id')->toArray();
        // Get all students as a collection
        $allStudents = Student::where('id', '<>', $request->id)->get();

        // Validate the request data
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'max:255', Rule::unique('students')->ignore($student->id)],
            'mobile' => [ 'max:255', Rule::unique('students')->ignore($student->id)],
            'alt_mobile' => 'nullable|max:255',
            'nid' => ['nullable', 'max:255', Rule::unique('students')->ignore($student->id)],
            'blood' => 'nullable|max:255',
            'present_address' => 'nullable|string|max:1000',
            'permanent_address' => 'nullable|string|max:1000',
            'mother_name' => 'nullable|max:255',
            'father_name' => 'nullable|max:255',
            'date_of_birth' => 'nullable|max:255',
            'admission_date' => 'nullable|max:255',
            'religious' => 'nullable|max:255',
            'department' => ['required','exists:class_models,id'],
            // Add other validation rules for additional fields
        ]);

        if ($validator->fails()) {
//            dd($validator->errors()->all());
            return '';
        }
        if ($request->email !== $student->email &&
                $allStudents->where('email', $request->email)->count() > 0 &&
               $userModel->where('email', $request->email)->count() > 0)
        {
            return '';
        }

        if ($request->mobile !== $student->mobile && $allStudents->where('mobile', $request->mobile)->count() > 0) {
            return '';
        }

        if (!empty($request->nid) && $request->nid !== $student->nid && $allStudents->where('nid', $request->nid)->count() > 0) {
            return '';
        }


        // Update the student's information
        $student->fill($request->except(['_token', 'id', 'image']));
        // Manually set values for fields that might be null or empty
        $student->blood = $request->input('blood', null);
        $student->present_address = $request->input('present_address', null);
        $student->permanent_address = $request->input('permanent_address', null);
        $student->mother_name = $request->input('mother_name', null);
        $student->father_name = $request->input('father_name', null);
        $student->date_of_birth = $request->input('date_of_birth', null);
        $student->admission_date = $request->input('admission_date', null);
        $student->religious = $request->input('religious', null);
        if(!empty($request->password))
        {
            $student->password = $request->password;
        }

        if (!empty($request->image)) {
            $student->image = self::getImageUrl($request);
        }

        $student->save();
        $user = new User();
        $user->name = $student->first_name. ' ' .$student->last_name;
        $user->email = $student->email;
        $user->password = $student->password;
        $user->user_type = 3;
        $user->status = $student->status;
        $user->save();

        return $student;



//        $allStudent = DB::table('students')
//            ->select('students.*')
//            ->get();
//        $student =  Student::findOrFail($request->id);
//        $student->first_name = $request->first_name;
//        $student->last_name = $request->last_name;
//        if($request->email != $student->email)
//        {
//            if($allStudent->email != $request->email)
//            {
//                $student->email = $request->email;
//            }
//            else
//            {
//                return '';
//            }
//
//        }
//        if( !($student->mobile == $request->mobile))
//        {
//            if($allStudent->mobile != $request->mobile)
//            {
//                $student->mobile = $request->mobile;
//            }
//            else
//            {
//                return '';
//            }
//        }
//        if(!empty($request->alt_mobile))
//        {
//            $student->alt_mobile = $request->alt_mobile;
//        }
//        if(!empty($request->department))
//        {
//            $student->department  = $request->department;
//
//        } if(!empty($request->religious))
//    {
//        $student->religious = $request->religious;
//    }
//        if(!empty($request->student_id))
//        {
//            $student->student_id = $request->student_id;
//        }
//        if(!empty($request->admission_date))
//        {
//            $student->admission_date   = $request->admission_date;
//        }
//        if(!empty($request->date_of_birth))
//        {
//            $student->date_of_birth   = $request->date_of_birth;
//        }
//        if(!empty($request->blood))
//        {
//            $student->blood    = $request->blood;
//        }
//        if(!empty($request->father_name))
//        {
//            $student->father_name    = $request->father_name;
//        }
//
//        (!empty($request->mother_name) ? $student->mother_name = $request->mother_name : '');
//        (!empty($request->permanent_address) ? $student->permanent_address = $request->permanent_address : '');
//
//        if(!empty($request->present_address))
//        {
//            $student->present_address   = $request->present_address;
//        }
//        if(!empty($request->nid))
//        {
//            if(($request->nid != $student->nid))
//            {
//                if($allStudent->nid != $request->nid)
//                {
//                    $student->nid = $request->nid;
//                }
//                else
//                {
//                    return '';
//                }
//            }
//        }
//        if(!empty($request->status))
//        {
//            $student->status  = $request->status;
//        }
//        if(!empty($request->image))
//        {
//            $student->image  = self::getImageUrl($request);
//        }
//
//        $student->save();
//        return $student;
    }







    public static function getImageUrl($request)
    {
        $image =$request->file('image');
        $imageNewName = 'admin-pro'.'.'.rand(1000000, 999999).'.'.$image->getClientOriginalExtension();
        $directory = 'public/admin/image/profile/';
        $image->move($directory, $imageNewName);
        $imgUrl = $directory.$imageNewName;
        return $imgUrl;
    }


}
