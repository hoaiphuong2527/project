@extends('admin.masterpage.masterpage')
@section('content')
<div>
<a href="{{ URL::asset('/categories/create') }}" class="btn btn-success" style="margin-bottom:20px;">Create New</a>
<br>
</div>
<div class="row clearfix progress-box">
   <div class="col-lg-7 col-md-6 col-sm-12 mb-30 pd-20 bg-white border-radius-4 box-shadow mb-30">
    <table class="table table-bordered">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $row)   
                    <tr cate-id="{{ $row->id }}">
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->name }}</td>
                        <td  class="text-center">
                            <a href="{{ URL::route('categories.edit', ['id' => $row->id,
                                                                        '_token' => csrf_token()
                                                                    ])
                                    }}">
                                <i class="fa fa-edit f-tb-icon"></i>
                            </a>
                            <div class=" btn-delete-categories">
                                <i class="fa fa-trash-o f-tb-icon"></i>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $categories->links() }}
   </div>
   <div class="col-lg-4 col-md-6 col-sm-12 mb-30 pd-20 bg-white border-radius-4 box-shadow mb-30" style="margin-left:30px">
        <h4 class="text-blue">Search category</h4>
        <hr>
        <form method="GET">
            <div class="form-group row">
                <label class="col-sm-12 col-md-3 col-form-label">Name</label>
                <div class="col-sm-12 col-md-9">
                    <input class="form-control" name="name" type="text" value="{{ $name }}">
                </div>
            </div>
            <button  class="btn btn-info" style="float: right;">Search</button>
        </form>					
   </div>
</div>

@endsection