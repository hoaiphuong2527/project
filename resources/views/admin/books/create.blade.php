@extends('admin.masterpage.masterpage')
@section('content')
<div class="row clearfix progress-box">
<div class="col-lg-12 col-md-6 col-sm-12 mb-30 pd-20 bg-white border-radius-4 box-shadow mb-30">
        <h4 class="text-blue">Create new a book</h4>
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
                <label class="col-sm-12 col-md-3 col-form-label">Title</label>
                <div class="col-sm-12 col-md-9">
                    <input name="title" class="form-control" type="text"  value="{{ old('title') }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-3 col-form-label">Author</label>
                <div class="col-sm-12 col-md-9">
                    <input class="form-control" name="author" value="{{ old('author') }}">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-3 col-form-label">Type</label>
                <div class="col-sm-12 col-md-9">
                    <select class="custom-select form-control" name="type">
                        @foreach($types as $key => $type)
                            <option value="{{ $key }}" @if (old('type') == $key) selected @endif>{{$type}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-3 col-form-label">Category</label>
                <div class="col-sm-12 col-md-9">
                    <select class="custom-select form-control" name="category">
                        @foreach($categories as $cate)
                            <option value="{{ $cate->id }}" @if (old('category') == $cate->id) selected @endif>{{$cate->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button class="btn btn-info" style="float: right;">Save</button>
        </form>					
   </div>
</div>

@endsection