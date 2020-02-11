@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create task</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Invite task</a></li>
                        <li class="breadcrumb-item active">Invite task by mail</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Task details</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post" action="{{ route('manage.tasks.store') }}">
                            @csrf
                            @method('post')
                            <div class="card-body">
                                <div class="form-group">
                                    @if (session('message'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('message') }}
                                        </div>
                                    @endif

                                    <label for="exampleInputEmail1">Title</label>
                                    <input type="text" name="title" value="{{ old('title') }}" class="form-control" id="exampleInputEmail1" placeholder="Title">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="state" value="new">
                                    <label for="exampleInputPassword1">Description</label>
                                    <input type="text" class="form-control" name="description" value="{{ old('description') }}" placeholder="Description">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Assignee</label>
                                    <select class="form-control select2" name="assignee" style="width: 100%;">
                                        @foreach($staffs as $staff)
                                            <option value="{{ $staff->id  }}">{{ $staff->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

@endsection
