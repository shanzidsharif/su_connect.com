@extends('master')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- /.row -->
                <div class="row">
                    <div class="col-12">
{{--                        <div class="card">--}}
{{--                            <div class="card-header">--}}
{{--                                <h3 class="card-title">Edit Subject</h3>--}}
{{--                            </div>--}}
{{--                            <!-- /.card-header -->--}}
{{--                            <form action="{{ route('update.subject') }}" method="post">--}}
{{--                                @csrf--}}
{{--                                <input type="hidden" value="{{  $list->id }}" name="id">--}}
{{--                                <div class="card-body">--}}
{{--                                    @include('_message')--}}
{{--                                    <div class="form-group row">--}}
{{--                                        <label for="" class="col-md-3">Subject Name</label>--}}
{{--                                        <input type="text" name="name" class="col-md-9 form-control" required value="{{ old('name',$list->name) }}">--}}
{{--                                        <div class="text-danger">--}}
{{--                                            {{ $errors->first('name') }}--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group row">--}}
{{--                                        <label for="" class="col-md-3">Subject Code</label>--}}
{{--                                        <input type="text" name="code" class="col-md-9 form-control" required value="{{ old('code',$list->code) }}">--}}
{{--                                        <div class="text-danger">--}}
{{--                                            {{ $errors->first('code') }}--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group row">--}}
{{--                                        <label for="" class="col-md-3">Type</label>--}}
{{--                                        <select name="subject_type" class="col-md-9 form-control" id="">--}}
{{--                                            <option value=""  disabled>--Select Subject Type--</option>--}}
{{--                                            <option {{ $list->subject_type == 1 ? 'selected' : '' }} value="1">Theory</option>--}}
{{--                                            <option {{ $list->subject_type == 2 ? 'selected' : '' }} value="2">Lab</option>--}}
{{--                                        </select>--}}

{{--                                    </div>--}}

{{--                                    <div class="form-group row">--}}
{{--                                        <label for="" class="col-md-3">Status</label>--}}
{{--                                        <select name="status" class="col-md-9 form-control" id="">--}}
{{--                                            <option value=""  disabled>--Select Status--</option>--}}
{{--                                            <option {{ $list->status == 1 ? 'selected' : '' }} value="1">Active</option>--}}
{{--                                            <option {{ $list->status == 0 ? 'selected' : '' }} value="0">Inactive</option>--}}
{{--                                        </select>--}}

{{--                                    </div>--}}


{{--                                    <div class="mt-3 col-md-6 offset-3">--}}
{{--                                        <input type="submit" class="btn btn-outline-success form-control" value="Update Subject">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </form>--}}
{{--                            <!-- /.card-body -->--}}
{{--                        </div>--}}
                        <!-- /.card -->


    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Assign Subject</h3>
        </div>
        <!-- /.card-header -->
        <form action="{{ route('update.subject.class') }}" method="POST">
            @csrf
            <div class="card-body">
                @include('_message')
                <input type="hidden" name="id" value="{{ $sub->id }}">
                <input type="hidden" name="assigned_by" value="{{ $users->email }}">
                <div class="form-group row">
                    <label for="" class="col-md-3">Department</label>
                    <select name="class_id" class="col-md-9 form-control" id="">
                        <option value=""disabled>-- Select Department --</option>
                            @foreach( $classes as $item)
                            <option  value="{{ $item->id }}" {{ $item->id == $sub->class_id ? 'selected' : '' }}>{{ $item->department }} ({{ $item->year }} Y)</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group row">
                    <label for="" class="col-md-3">Semester</label>
                    <select name="semester" class="col-md-9 form-control" id="">
                        <option value=""disabled>-- Select Semester --</option>
                        @for( $semester= 1; $semester <=12; $semester++)
                            <option  value="{{ $semester }}" {{ $semester == $sub->semester ? 'selected' : '' }}>{{ $semester }}</option>
                        @endfor
                    </select>
                </div>
                <div class="row">
                    <label for="" class="col-md-3">Subject</label>
                    <div class="col-md-9">
                        <div class="row">
                            @foreach( $subjects as $item)
                                @if($loop->index % 3 == 0 && $loop->index > 0)

                                    <div class="mb-2"><br></div>
                                @endif
                                <div class="col-md-4">
                                    <input type="checkbox" name="subject_id[]" value="{{ $item->id }}" style="transform: scale(1.4);"
                                        {{ (in_array( $item->id , $assign_subject )? 'checked' : '') }}>
                                    <span class="ml-1">{{ $item->name }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="mt-3 col-md-6 offset-3">
                    <input type="submit" class="btn btn-outline-success form-control" value="Update Assign Subject">
                </div>
            </div>
        </form>
        <!-- /.card-body -->
    </div>
                    </div>
                </div>
                <!-- /.row -->
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection


