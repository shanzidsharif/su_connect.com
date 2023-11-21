<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class Lecturer extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'mobile',
        'first_name',
        'last_name',
        'email',
    ];


    public static function insert($request)
    {
        $allLecturers = Lecturer::all();
        $userModel = User::all();
//        dd($request->all());
        $lecturer = new Lecturer();
        $lecturer->first_name = $request->first_name;
        $lecturer->last_name = $request->last_name;
        if (($allLecturers->where('email', $request->email)->count() > 0) &&
                ($userModel->where('email', $request->email)->count() > 0))
        {
            return '';
        }
        else {
            $lecturer->email = $request->email;
        }
        if ($allLecturers->where('mobile', $request->mobile)->count() > 0) {
            return '';
        } else {
            $lecturer->mobile = $request->mobile;
        }

        if (!empty($request->department)) {
            $lecturer->department = $request->department;

        }
        if (!empty($request->gender)) {
            $lecturer->gender = $request->gender;
        }
        if (!empty($request->lecturer_id)) {
            $lecturer->lecturer_id = $request->lecturer_id;
        }
        if (!empty($request->joining_date)) {
            $lecturer->joining_date = $request->joining_date;
        }
        if (!empty($request->date_of_birth)) {
            $lecturer->date_of_birth = $request->date_of_birth;
        }
        if (!empty($request->position)) {
            $lecturer->position = $request->position;
        }
        if (!empty($request->maritial_status)) {
            $lecturer->maritial_status = $request->maritial_status;
        }

        (!empty($request->experience) ? $lecturer->experience = $request->experience : '');
        (!empty($request->present_address) ? $lecturer->present_address = $request->present_address : '');
        (!empty($request->permanent_address) ? $lecturer->permanent_address = $request->permanent_address : '');
        (!empty($request->bio) ? $lecturer->bio = $request->bio : '');
        (!empty($request->semester_assign_id) ? $lecturer->semester_assign_id = $request->semester_assign_id : '');
        (!empty($request->qualification) ? $lecturer->qualification = $request->qualification : '');

        if (!empty($request->nid)) {
            $lecturer->nid = $request->nid;
        }
        if (!empty($request->status)) {
            $lecturer->status = $request->status;
        }
        if (!empty($request->image)) {
            $lecturer->image = self::getImageUrl($request);
        }
        $lecturer->password = Bcrypt($request->email);

        $lecturer->save();
//        dd($lecturer);
        $user = new User();
        $user->name = $lecturer->first_name. ' ' .$lecturer->last_name;
        $user->email = $lecturer->email;
        $user->password = $lecturer->password;
        $user->user_type = 2;
        $user->status = $lecturer->status;
        $user->save();
        return $lecturer;
    }


    public static function getImageUrl($request)
    {
        $image = $request->file('image');
        $imageNewName = 'admin-pro' . '.' . rand(1000000, 999999) . '.' . $image->getClientOriginalExtension();
        $directory = 'public/admin/image/profile/';
        $image->move($directory, $imageNewName);
        $imgUrl = $directory . $imageNewName;
        return $imgUrl;
    }

    public static function updateLecturer($request)
    {
        $userCheck = User::where('email', $request->email)->first();
        $lecturer = Lecturer::findOrFail($request->id);
        $allDepartment = ClassModel::pluck('id')->toArray();
        // Get all students as a collection
        $allLecturer = Student::where('id', '<>', $request->id)->get();

        // Validate the request data
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'max:255', Rule::unique('lecturers')->ignore($lecturer->id)],
            'mobile' => ['max:255', Rule::unique('lecturers')->ignore($lecturer->id)],
            'nid' => ['nullable', 'max:255', Rule::unique('lecturers')->ignore($lecturer->id)],
            'present_address' => 'nullable|string|max:1000',
            'permanent_address' => 'nullable|string|max:1000',
            'bio' => 'nullable|string|max:1000',
            'lecturer_id' => ['max:255', Rule::unique('lecturers')->ignore($lecturer->id)],
            'date_of_birth' => 'nullable|max:255',
            'joining_date' => 'nullable|max:255',
            'qualification' => 'nullable|max:255',
            'department' => ['required', 'exists:class_models,id'],
            // Add other validation rules for additional fields
        ]);

        if ($validator->fails()) {
//            dd($validator->errors()->all());
            return '';
        }
        if ($request->email !== $lecturer->email && $userCheck->email !== $request->email && $allLecturer->where('email', $request->email)->count() > 0) {
            return '';
        }

        if ($request->mobile !== $lecturer->mobile && $allLecturer->where('mobile', $request->mobile)->count() > 0) {
            return '';
        }

        if (!empty($request->nid) && $request->nid !== $lecturer->nid && $allLecturer->where('nid', $request->nid)->count() > 0) {
            return '';
        }


        // Update the student's information
        $lecturer->fill($request->except(['_token', 'id', 'image']));
        // Manually set values for fields that might be null or empty
        $lecturer->present_address = $request->input('present_address', null);
        $lecturer->permanent_address = $request->input('permanent_address', null);
        $lecturer->bio = $request->input('bio', null);
        $lecturer->qualification = $request->input('qualification', null);
        $lecturer->date_of_birth = $request->input('date_of_birth', null);
        $lecturer->joining_date = $request->input('joining_date', null);
        $lecturer->department = $request->input('department', null);

        if (!empty($request->image)) {
            $lecturer->image = self::getImageUrl($request);
        }
        if (!empty($request->password)) {
            $lecturer->password = $request->password;
        }

        $lecturer->save();


        $user = new User();
        $user->name = $lecturer->first_name. ' ' .$lecturer->last_name;
        $user->email = $lecturer->email;
        $user->password = $lecturer->password;
        $user->user_type = 2;
        $user->status = $lecturer->status;
        $user->save();

        return $lecturer;


    }
}
