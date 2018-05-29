@extends('admin.masterpage.masterpage')
@section('content')

<div class="row clearfix progress-box">
   <div class="col-lg-6 col-md-6 col-sm-12 mb-30 pd-20 bg-white border-radius-4 box-shadow mb-30">
        <h4 class="text-blue">User's information</h4>
        <hr>
        <div class="form-group row">
            <label class="col-sm-12 col-md-3 col-form-label">Username</label>
            <lable class="col-sm-12 col-md-9" style="margin-top: 3px;">
                {{ $user->name }}
            </lable>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-3 col-form-label">Email</label>
            <lable class="col-sm-12 col-md-9" style="margin-top: 3px;">
            {{$user->email}}
            </lable>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-3 col-form-label">Phone</label>
            <lable class="col-sm-12 col-md-9" style="margin-top: 3px;">
            {{$user->phone}}
            </lable>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-3 col-form-label">Role</label>
            <lable class="col-sm-12 col-md-9" style="margin-top: 3px;">
            {{$user->name}}
            </lable>
        </div>
   </div>
   <div class="col-lg-5 col-md-6 col-sm-12 mb-30 pd-20 bg-white border-radius-4 box-shadow mb-30" style="margin-left:30px">
        <h4 class="text-blue">Provide</h4>
        <hr>
        <table class="table table-bordered">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Author</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $row)   
                    <tr user-id="{{ $row->id }}">
                        <td>{{ $row->id }}</td>
                        <td><a href="{{ URL::route('user.detail', ['id' => $row->id,
                                                                        '_token' => csrf_token()
                                                                    ])
                                    }}" class="text-blue">{{ $row->name }}</a></td>
                        <td>{{ $row->email }} </td>
                        <td>{{ $row->phone }}</td>
                        <td  class="text-center">
                            <a href="{{ URL::route('user.edit', ['id' => $row->id,
                                                                        '_token' => csrf_token()
                                                                    ])
                                    }}">
                                <i class="fa fa-edit f-tb-icon"></i>
                            </a>
                            <div class=" btn-delete-user">
                                <i class="fa fa-trash-o f-tb-icon"></i>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>				
   </div>
</div>

@endsection