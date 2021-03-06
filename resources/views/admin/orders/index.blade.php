@extends('admin.masterpage.masterpage')
@section('content')
<div>
<a href="{{ URL::route('orders.create') }}" class="btn btn-success" style="margin-bottom:20px;">Create New</a>
<br>
</div>
<div class="row clearfix progress-box">
   <div class="col-lg-7 col-md-6 col-sm-12 mb-30 pd-20 bg-white border-radius-4 box-shadow mb-30">
        <table class="table table-bordered">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Username</th>
                <th scope="col">Book</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($list as $row)   
                    <tr book-id="{{ $row->id }}">
                        <td>{{ $row->id }}</td>
                        <td><a href="{{ URL::route('orders.create', ['id' => $row->id,
                                                                        '_token' => csrf_token()
                                                                    ])
                                    }}" class="text-blue">{{ $row->user->name }}</a></td>
                        <td><ul>
                            <li>gsgsg</li>
                            <li>gsgsg</li>
                        </ul>
                        </td>
                        <td  class="text-center">
                            <a href="{{ URL::route('orders.edit', ['id' => $row->id,
                                                                        '_token' => csrf_token()
                                                                    ])
                                    }}">
                                <i class="fa fa-reply f-tb-icon"></i>
                            </a><br>
                            <a href="{{ URL::route('orders.edit', ['id' => $row->id,
                                                                        '_token' => csrf_token()
                                                                    ])
                                    }}">
                                <i class="fa fa-edit f-tb-icon"></i>
                            </a>
                            
                            <div class=" btn-delete-book">
                                <i class="fa fa-trash-o f-tb-icon"></i>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $list->links() }}
   </div>
   <div class="col-lg-4 col-md-6 col-sm-12 mb-30 pd-20 bg-white border-radius-4 box-shadow mb-30" style="margin-left:30px">
        <h4 class="text-blue">Search</h4>
        <hr>
        <form method="GET">
            <div class="form-group row">
                <label class="col-sm-12 col-md-3 col-form-label">Username</label>
                <div class="col-sm-12 col-md-9">
                    <input class="form-control" name="title" type="text" value="">
                </div>
            </div>
            <button  class="btn btn-info" style="float: right;">Search</button>
        </form>					
   </div>
</div>

@endsection