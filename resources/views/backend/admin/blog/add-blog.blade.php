@extends('backend.admin.layouts.master')

@section('main-content')
    <div class="container-fluid" style="min-height: 100vh">
        <div class="row mt-5">
            <main class="content">
                <div class="container-fluid p-0">
                    <div class="mb-3">
                        <h1 class="h3 d-inline align-middle">Add Blog</h1>

                    </div>
                    <div class="row">
                        <form action="{{ route('admin.blog.store') }}" id="blog" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="card-header">
                                            <h5 class="card-title mb-0">Title</h5>
                                        </div>
                                        <div class="card-body">
                                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" placeholder="Enter Title">
                                            <span class="text-danger">
                                                @error('title')
                                                {{$message}}   
                                                @enderror
                                            </span>
                                        </div>
                                        <div class="card-header">
                                            <h5 class="card-title mb-0">Image</h5>
                                        </div>
                                        <div class="card-body">
                                            <input type="file" class="form-control" id="image" name="image">
                                            <span class="text-danger">
                                                @error('image')
                                                {{$message}}   
                                                @enderror
                                            </span>
                                        </div>
                                        <div class="card-body" id="preview"></div>

                                        <div class="mt-3">
                                            <label class="form-check form-check-inline">
                                                <h5 class="card-title">Status</h5>
                                            </label>
                                            <label class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="status"
                                                    checked value="1">
                                                <span class="form-check-label">
                                                    Active
                                                </span>
                                            </label>
                                            <label class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="status"
                                                    value="0">
                                                <span class="form-check-label">
                                                    Inactive
                                                </span>
                                            </label>
                                        </div>

                                        <div class="card-body">
                                            <button class="btn btn-primary" type="submit">Submit</button>
                                            <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary">Cancle</a>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="card-header">
                                            <h5 class="card-title mb-0">Description</h5>
                                        </div>
                                        <div class="card-body">
                                            <input type="text" name="description" id="description" class="form-control" value="{{ old('description') }}" placeholder="Write description here">
                                            <span class="text-danger">
                                                @error('description')
                                                {{$message}}   
                                                @enderror
                                            </span>
                                        </div>
                                        <div class="card-header">
                                            <h5 class="card-title mb-0">Body</h5>
                                        </div>
                                        <div class="card-body">
                                            <textarea class="form-control" id="body" name="body" rows="4" value="{{ old('body') }}" placeholder="Write body here"></textarea>
                                            <span class="text-danger">
                                                @error('body')
                                                {{$message}}   
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection

@push('script')
<script src="{{ asset('/admin/js/blog.js') }}"></script>   
@endpush
