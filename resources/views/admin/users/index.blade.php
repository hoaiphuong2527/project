@extends('admin.masterpage.masterpage')
@section('content')
<div>
<a href="{{ URL::asset('/users/create') }}" class="btn btn-success" style="margin-bottom:20px;">Create New</a>
<br>
</div>
<div class="row clearfix progress-box">
   <div class="col-lg-7 col-md-6 col-sm-12 mb-30 pd-20 bg-white border-radius-4 box-shadow mb-30">
    <table class="table table-bordered">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $row)   
                    <tr user-id="{{ $row->id }}">
                        <td>{{ $row->id }}</td>
                        <td><a href="{{ URL::route('user.detail', ['id' => $row->id,
                                                                        '_token' => csrf_token()
                                                                    ])
                                    }}" class="text-blue">{{ $row->username }}</a></td>
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
        {{ $users->links() }}
   </div>
   <div class="col-lg-4 col-md-6 col-sm-12 mb-30 pd-20 bg-white border-radius-4 box-shadow mb-30" style="margin-left:30px">
        <h4 class="text-blue">Search user</h4>
        <hr>
        <form method="GET">
            <div class="form-group row">
                <label class="col-sm-12 col-md-3 col-form-label">Username</label>
                <div class="col-sm-12 col-md-9">
                    <input class="form-control" name="name" type="text" value="{{ $name }}" placeholder="Johnny Brown">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-3 col-form-label">Email</label>
                <div class="col-sm-12 col-md-9">
                    <input class="form-control" value="{{ $email }}" name="email" placeholder="bootstrap@example.com" type="email">
                </div>
            </div>
            
            <div class="form-group row">
                <label class="col-sm-12 col-md-3 col-form-label">Phone</label>
                <div class="col-sm-12 col-md-9">
                    <input class="form-control" name='phone' value="{{ $phone }}" type="tel">
                </div>
            </div>
            <button  class="btn btn-info" style="float: right;">Search</button>
        </form>					
   </div>
</div>

@endsection