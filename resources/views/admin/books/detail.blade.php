@extends('admin.masterpage.masterpage')
@section('content')
<?php 
    use App\Models\User;
?>
<div class="row clearfix progress-box">
   <div class="col-lg-12 col-md-12 col-sm-12 mb-30 pd-20 bg-white border-radius-4 box-shadow mb-30">
        <h4 class="text-blue">Book's information</h4>
        <hr>
        <div class="form-group row">
            <label class="col-sm-12 col-md-3 col-form-label">Title</label>
            <lable class="col-sm-12 col-md-9" style="margin-top: 3px;">
                {{ $book->title }}
            </lable>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-3 col-form-label">Author</label>
            <lable class="col-sm-12 col-md-9" style="margin-top: 3px;">
                {{$book->author}}
            </lable>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-3 col-form-label">Type</label>
            <lable class="col-sm-12 col-md-9" style="margin-top: 3px;">
                @if($book->category_id == 0)
                    Book
                @else
                    Ebook
                @endif
                
            </lable>
        </div>
   </div>
</div>

@endsection