<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubjectModel;
use App\Models\ClassModel;
use App\Models\User;
use DB;

class ClassSubjectModel extends Model
{
    use HasFactory;
    public static function insert($request)
    {
        $class_subject = [];
        $year = ClassModel::where('id', $request->class_id)->first();
        foreach ($request->subject_id as $item)
        {
            $class_subject = new ClassSubjectModel();
            $class_subject->class_id = $request->class_id;
            $class_subject->year = $year->year;
            $class_subject->semester = $request->semester;
            $class_subject->assigned_by = $request->assigned_by;
            $class_subject->subject_id = $item;
            $class_subject->save();
        }
        return $class_subject;
    }

    public static function updateAssignSubject($request)
    {
        $class_subject = [];
        $year = ClassModel::where('id', $request->class_id)->first();

//        dd($request->all());

        foreach ($request->subject_id as $item)
        {
            $class_subject = new ClassSubjectModel();
            $class_subject->class_id = $request->class_id;
            $class_subject->year = $year->year;
            $class_subject->semester = $request->semester;
            $class_subject->assigned_by = $request->assigned_by;
            $class_subject->subject_id = $item;
            $class_subject->save();
        }
        return $class_subject;

    }
}
