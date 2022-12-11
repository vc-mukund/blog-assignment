@extends('backend.admin.layouts.master')

@section('main-content')
    <div class="container-fluid">
        <div class="row mt-5" style="min-height: 100vh">
            <div class="col-lg-12">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h2>User data</h2>
                        {{-- <div class="col-md-8"> --}}
                        @role('admin')
                            <a href="{{ route('admin.user.create') }}" style="float:right"><button
                                    class="btn btn-secondary btn">Add User</button></a>
                        @endrole
                        {{-- </div> --}}
                    </div>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('danger'))
                        <div class="alert alert-danger">
                            {{ session('success') }}
                        </div>
                    @endif
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Date Of Birth</th>
                                <th>Verified</th>
                                <th>Role</th>
                                <th>Created At</th>
                                @role('admin')
                                    <th>Action</th>
                                @endrole
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $user->fname }}</td>
                                    <td>{{ $user->lname }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->dob }}</td>
                                    <td>
                                        @if ($user->verified)
                                            <span class="badge bg-success">
                                                Verified
                                            </span>
                                        @else
                                            <span class="badge bg-danger">
                                                Unverified
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if (!$user->roles->isEmpty())
                                            @foreach ($user->roles as $role)
                                                {{ $role->name }}
                                            @endforeach
                                        @else
                                            User
                                        @endif
                                    </td>
                                    <td>{{ $user->created_at }}</td>
                                    @role('admin')
                                        <td>
                                            <a href="{{ route('admin.user.edit', $user->id) }}"><i class="align-middle me-2"
                                                    data-feather="edit"></i> </a>

                                            <a href="{{ route('admin.user.delete', $user->id) }}"
                                                onclick="return confirm('Are you sure to delete')"><i class="align-middle me-2"
                                                    data-feather="delete"></i></a>
                                        </td>
                                    @endrole
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
