@extends('backend.admin.layouts.master')

@section('main-content')
    <div class="container-fluid">
        <div class="row mt-5" style="min-height: 100vh">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Blog data</h2>
                        @role('editor')
                            <a href="{{ route('admin.blog.create') }}" style="float:right"><button
                                    class="btn btn-secondary btn">Add Blog</button></a>
                        @endrole
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th style="width:25%">Title</th>
                                    <th style="width:25%">Description</th>
                                    @role('admin')
                                        <th>Publish By</th>
                                    @endrole
                                    <th>Status</th>
                                    <th>Created At</th>
                                    @role('editor')
                                        <th>Action</th>
                                    @endrole
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($blogs as $blog)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>
                                            <img src="{{ $blog->image }}" alt="" width="50px">
                                        </td>
                                        <td>{{ $blog->title }}</td>
                                        <td>{{ $blog->description }}</td>
                                        @role('admin')
                                            <td>{{ $blog->user->fname }}</td>
                                        @endrole
                                        <td>
                                            @if ($blog->status == 1)
                                                <span class="badge bg-success">
                                                    Active
                                                </span>
                                            @else
                                                <span class="badge bg-danger">
                                                    Inactive
                                                </span>
                                            @endif
                                        </td>
                                        <td>{{ $blog->created_at }}</td>

                                        @role('editor')
                                            <td>
                                                <a href="{{ route('admin.blog.edit', $blog->id) }}"><i class="align-middle me-2"
                                                        data-feather="edit"></i></a>

                                                <a href="{{ route('admin.blog.delete', $blog->id) }}"
                                                    onclick="return confirm('Are you sure to delete')"><i
                                                        class="align-middle me-2" data-feather="delete"></i></a>
                                            </td>
                                        @endrole
                                        {{-- <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    data-id="{{ $blog->id }}" {{ $blog->status ? 'checked' : '' }}>
                                            </div>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
