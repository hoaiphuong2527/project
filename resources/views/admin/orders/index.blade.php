@extends('admin.masterpage.masterpage')
@section('content')
<?php use App\Models\User; ?>
<div>
<a href="{{ URL::route('orders.create') }}" class="btn btn-success" style="margin-bottom:20px;">Create New</a>
<br>
</div>
<div class="row clearfix progress-box">
   <div class="col-lg-7 col-md-6 col-sm-12 mb-30 pd-20 bg-white border-radius-4 box-shadow mb-30">
    <span class="help-block">
        <h5 style="color: red;">
        {{ $errors->first('error') }}
        </h5>
    </span>
        <table class="table table-bordered">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Username</th>
                <th scope="col">Book</th>
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($list as $row)   
                    <tr order-id="{{ $row->id }}">
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->borrower->username }}</a></td>
                        <td>
                             <?php
                             $item = App\Models\Order::find($row->id)->orderItems;
                             foreach ($item as $val) {
                             $title = App\Models\BookItem::find((int) $val->book_item_id); ?>
                                 <ul>
                                    <li>{{ $title->book->title }}</li>
                                </ul>
                                <?php
                             }
                             ?>
                        
                        </td>
                        <td>
                             @if($row->status == 0)
                                Borrowing
                             @else  
                                Returned
                             @endif   
                        </td>
                        <td  class="text-center">
                            <a href="{{ URL::route('orders.return', ['id' => $row->id,
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
                            
                            <div class="btn-delete-order">
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
                    <input class="form-control" name="name" type="text" value="{{ old('name',$name) }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-3 col-form-label">Status</label>
                <div class="col-sm-12 col-md-9">
                    <select class="custom-select form-control" name="status">
                            <option value="all" @if ($status == "all") selected @endif>Any</option>
                            <option value="borrowing" @if ($status == "borrowing") selected @endif>Borrowing</option>
                            <option value="returned" @if ($status == "returned") selected @endif>Returned</option>
                    </select>
                </div>
            </div>
            <button  class="btn btn-info" style="float: right;">Search</button>
        </form>					
   </div>
</div>

@endsection