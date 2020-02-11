@extends('layouts.app')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-12">
                        <a href="{{ route('manage.staffs.create') }}">
                            <button class="btn btn-link" type="submit">Create staff</button>
                        </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Staffs</h3>

                            <div class="card-tools">
                                {{ $staffs->links()   }}
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($staffs as $staff)
                                    <tr>
                                        <td>{{ $staff->id }}</td>
                                        <td>{{ $staff->name }}</td>
                                        <td>
                                            <span class="badge {{ $staff->state == 'competed' ? 'bg-success' :'bg-warning' }}">{{ $staff->state }}</span>
                                        </td>
                                        <td>
                                            <form method="post" action="{{ route('manage.staffs.delete', $staff->id ) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link">Delete</button>
                                            </form>
                                        </td>
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
