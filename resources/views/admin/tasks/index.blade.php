@extends('layouts.app')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('manage.tasks.create') }}">
                        <button class="btn btn-link" type="submit">Create task</button>
                    </a>
                </div>
            </div>
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tasks</h3>

                            <div class="card-tools">
                                {{ $tasks->links()   }}
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Task</th>
                                    <th>Description</th>
                                    <th>Assignee</th>
                                    <th style="width: 40px">Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tasks as $task)
                                    <tr>
                                        <td>{{ $task->id }}</td>
                                        <td>{{ $task->title }}</td>
                                        <td>
                                            {{ $task->description  }}
                                        </td>
                                        <td>{{ $task->assignedUser? $task->assignedUser->name : 'Unassigned' }}</td>
                                        <td>
                                            <span class="badge {{ $task->state == 'completed' ? 'bg-success' :'bg-warning' }}">{{ $task->state }}</span>
                                        </td>
                                        {{--<td>
                                            <form method="post" action="{{ route('tasks.status', $task->id ) }}">
                                                @csrf
                                                @method('patch')
                                                <input type="state" hidden name="state" value="completed">
                                                <button class="btn btn-link" type="submit">Mark as complete</button>
                                            </form>
                                        </td>--}}
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@endsection
