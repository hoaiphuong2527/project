@extends('admin.masterpage.masterpage')
@section('content')
<div class="row clearfix progress-box">
<div class="col-lg-12 col-md-6 col-sm-12 mb-30 pd-20 bg-white border-radius-4 box-shadow mb-30">
        <h4 class="text-blue">Edit a user</h4>
        <hr>
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if (isset($message))
        <div class="alert alert-success">
        {{ $message }}
        </div>
        @endif
        <form method="post">
        {{ csrf_field() }}
            <div class="form-group row">
                <label class="col-sm-12 col-md-3 col-form-label">Username</label>
                <div class="col-sm-12 col-md-9">
                    <input name="name" class="form-control" type="text" placeholder="Johnny Brown" value="{{ old('name', $user->username) }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-3 col-form-label">Email</label>
                <div class="col-sm-12 col-md-9">
                    <input class="form-control" name="email" value="{{ old('email', $user->email) }}" type="email" placeholder="bootstrap@example.com" disabled>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-3 col-form-label">Password</label>
                <div class="col-sm-12 col-md-9">
                    <input class="form-control" name="password" value="" type="password">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-3 col-form-label">Confirm Password</label>
                <div class="col-sm-12 col-md-9">
                    <input class="form-control" name="password_confirmation" value="" type="password">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-3 col-form-label">Role</label>
                <div class="col-sm-12 col-md-9">
                    <select class="custom-select form-control" name="role">
                        @foreach($roles as $key => $role)
                            <option value="{{ $key }}"  {{ $key == $user->user_role ? 'selected' : '' }}>{{$role}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="form-group row">
                <label class="col-sm-12 col-md-3 col-form-label">Phone</label>
                <div class="col-sm-12 col-md-9">
                    <input class="form-control" name="phone" value="{{ old('phone', $user->phone) }}" type="tel">
                </div>
            </div>
            <button class="btn btn-info" style="float: right;">Save</button>
        </form>					
   </div>
</div>

@endsection