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
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Assign Subject</h3>
                            </div>
                            <!-- /.card-header -->
                            <form action="{{ route('insert.subject.class') }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    @include('_message')


                                    <div class="form-group row">
                                        <label for="" class="col-md-3">Department</label>
                                        <select name="class_id" class="col-md-9 form-control" id="">
                                            <option value="" selected disabled>-- Select Department --</option>
                                            @foreach( $list['classes'] as $item )
                                            <option value="{{ $item->id }}">{{ $item->department }} ({{ $item->year }})</option>
                                            @endforeach
                                        </select>
{{--                                        <input type="hidden" name="year" value="{{ $item->year }}">--}}

                                    </div>
                                        @php
                                            $semester = 1;
                                        @endphp

                                    <div class="form-group row">
                                        <label for="" class="col-md-3">Semester</label>
                                        <select name="semester" class="col-md-9 form-control" id="">
                                            <option value="" selected disabled>-- Select Semester --</option>
                                            @for( $semester= 1 ; $semester <= 12; $semester++)
                                            <option value="{{ $semester }}">{{ $semester }}</option>
                                            @endfor
                                        </select>

                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-md-3">Subjects</label>

                                                <div class="col-md-9 form-group">
                                                    @foreach( $list['subjects'] as $item )
                                                    <div class="row">
                                                        <div class="col-md-4 offset-1">
                                                            <input type="checkbox" name="subject_id[]" class="" value="{{ $item->id }}">
                                                            <span class="">{{ $item->name }}</span>
                                                        </div>
                                                        <div class="col-md-4 offset-1"></div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                    </div>
                                    <input type="hidden" value="{{ $list['users']->email }}" name="assigned_by">



                                    <div class="mt-3 col-md-6 offset-3">
                                        <input type="submit" class="btn btn-outline-success form-control" value="Create New Department">
                                    </div>
                                </div>
                            </form>
                                <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
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
