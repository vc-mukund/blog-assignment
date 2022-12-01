@extends('backend.admin.layouts.master')

@section('main-content')
<div class="container-fluid" style="min-height: 100vh">
<div class="row mt-5">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h2>Edit User</h2>
                <div class="form-validation mt-5">
                    <form class="form-valide" id="addUser" action="{{ route('admin.user.update') }}" method="post">
                        @csrf
                        <div class="form-group row justify-content-evenly mb-5">
                            <label class="col-lg-2 col-form-label" for="val-username">First Name <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-5">
                                <input type="text" class="form-control" id="fname" name="fname" value="{{ $user->fname }}">
                                <input type="hidden" name="id" value="{{ $user->id }}">
                                <span class="text-danger">
                                    @error('fname')
                                    {{$message}}   
                                    @enderror
                                </span>
                            </div> 
                        </div>

                        <div class="form-group row justify-content-evenly mb-5">
                            <label class="col-lg-2 col-form-label" for="val-username">Last Name <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-5">
                                <input type="text" class="form-control" id="lname" name="lname" value="{{ $user->lname }}">
                                <span class="text-danger">
                                    @error('lname')
                                    {{$message}}   
                                    @enderror
                                </span>
                            </div> 
                        </div>

                        <div class="form-group row justify-content-evenly mb-5 ">
                            <label class="col-lg-2 col-form-label" for="val-email">Email <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-5">
                                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                                <span class="text-danger">
                                    @error('email')
                                    {{$message}}   
                                    @enderror
                                </span>
                            </div>
                        </div>

                        <div class="form-group row justify-content-evenly mb-5">
                            <label class="col-lg-2 col-form-label" for="val-username">Date Of Birth <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-5">
                                <input type="date" class="form-control" id="dob" name="dob" value="{{ $user->dob }}">
                                <span class="text-danger">
                                    @error('dob     ')
                                    {{$message}}   
                                    @enderror
                                </span>
                            </div> 
                        </div>
                       
                        <div class="form-group row justify-content-evenly mb-5">
                            <label class="col-lg-2 col-form-label" for="val-skill">Verify <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-5">
                                <select class="form-control" id="verify" name="verify">
                                    <option {{ $user->verified == 1 ? 'selected' : ''}} value="1" selected>Verified</option>
                                    <option {{ $user->verified == 0 ? 'selected' : ''}} value="0">Unverified</option>
                                </select>
                                <span class="text-danger">
                                    @error('verify')
                                    {{$message}}   
                                    @enderror
                                </span>
                            </div>
                            
                        </div>
                        <div class="form-group row justify-content-evenly mb-5">
                            <label class="col-lg-2 col-form-label" for="val-skill">Role <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-5">
                                <select class="form-control" id="role" name="role">
                                    <option value="" selected disabled>Please select role</option>
                                    @if(!$user->roles->isEmpty())
                                        @foreach($user->roles as $item)
                                            @foreach($roles as $role)
                                                <option {{ $item->name == $role->name ? 'selected' : ''}} value="{{ $role->name }}">{{ $role->name }}</option>
                                            @endforeach
                                            <option value="">User</option>
                                        @endforeach
                                    @else
                                        @foreach($roles as $role)
                                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                                        @endforeach
                                            <option value="">User</option>
                                    @endif
                                </select>
                                <span class="text-danger">
                                    @error('role')
                                    {{$message}}   
                                    @enderror
                                </span>
                            </div>
                            
                        </div>
                        
                        <div class="form-group row  mb-5">
                            <div class="col-lg-4 offset-5 ml-auto">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">Cancel </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>
</div>
@endsection