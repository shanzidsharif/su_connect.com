<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubjectModel;

class ClassModel extends Model
{
    use HasFactory;
    public static function getClassData()
    {
        $classes = ClassModel::select('class_models.*')
                                ->orderBy('status', 'desc',['id', 'desc'])
                                ->paginate(5);
        return $classes;
    }
    public static function insert($request)
    {
        $duplicate = ClassModel::where('department', $request->department)
                                ->where('year', $request->year)
                                ->first();
        $class = new ClassModel();

        if(!empty($duplicate)){
            return '';
        }
        else{
            $class->department = $request->department;
            $class->year = $request->year;
            $class->save();
            return $class;
        }

    }
    public static function updateClass($request)
    {
        $class = ClassModel::where('id', $request->id)
            ->first();
        $duplicate = ClassModel::where('department', $request->department)
            ->where('year', $request->year)
            ->first();


        if(!empty($class) && empty($duplicate)){

            $class->department = $request->department;
            $class->year = $request->year;
            $class->save();
            return $class;
        }
        else{
            return '';
        }
    }


}
