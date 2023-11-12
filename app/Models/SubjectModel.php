<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectModel extends Model
{
    use HasFactory;
    public static function getSubjectData()
    {
        $subjects = SubjectModel::select('subject_models.*')
            ->orderBy('status', 'desc',['id', 'desc'])
            ->paginate(5);
        return $subjects;
    }

    public static function insert($request)
    {
        $duplicate = SubjectModel::where('code', $request->code)
            ->first();
        $subject = new SubjectModel();

        if(!empty($duplicate)){
            return '';
        }
        else{
            $subject->name = $request->name;
            $subject->code = $request->code;
            $subject->subject_type = $request->subject_type;
            $subject->save();
            return $subject;
        }
    }

    public static function updateSubject($request)
    {
        $subject = SubjectModel::where('id', $request->id)
            ->first();

        $duplicate = SubjectModel::where('code', $request->code)
            ->first();


        if(!empty($subject)){

            if($subject->code == $request->code)
            {

                $subject->name = $request->name;
                $subject->subject_type = $request->subject_type;
                $subject->status = $request->status;
                $subject->save();

            }
            else
            {



                if(!empty($duplicate))
                {
                    return '';
                }
                else
                {

                    $subject->name = $request->name;
                    $subject->code = $request->code;
                    $subject->subject_type = $request->subject_type;
                    $subject->status = $request->status;
                    $subject->save();
                }


            }

            return $subject;

        }
        else{
            return '';
        }
    }
}
