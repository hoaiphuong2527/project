@extends('admin.masterpage.masterpage')
@section('content')
<?php 
    use App\Models\Book;
?>
<div class="row clearfix progress-box">
<div class="col-lg-12 col-md-6 col-sm-12 mb-30 pd-20 bg-white border-radius-4 box-shadow mb-30">
        <h4 class="text-blue">Order</h4>
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
        <button class="btn btn-info" style="float: right; margin-right:20px;">Save</button><br><br>
        {{ csrf_field() }}

            <div class="form-group row" style = "width:80%; margin:auto;">
                <label class="col-sm-12 col-md-2 col-form-label">Username</label>
                <div class="col-sm-12 col-md-10">
                    <select class="custom-select form-control" name="user">
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" @if (old('user') == $user->id) selected @endif>{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <br>
            <table class="table table-bordered" style = "width:80%; margin:auto;">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Book</th>
                <th scope="col">Author</th>
                <th scope="col" class="text-center">Choose</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lists as $row)   
                    <tr book-id="{{ $row }}">
                        <td>{{ $row->book_id }}</td>
                        <td><a href="{{ URL::route('orders.create', ['id' => $row->id,
                                                                        '_token' => csrf_token()
                                                                    ])
                                    }}" class="text-blue"></a>{{ Book::find($row->book_id)->title }}</td>
                        <td>{{ Book::find($row->book_id)->author }}
                        </ul>
                        </td>
                        <td class="text-center" name="book[]">
                            <input type="checkbox" value=" {{ $row->id }}"><br>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </form>					
   </div>
</div>

@endsection