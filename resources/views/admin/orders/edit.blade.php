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
                            <option value="{{ $user->id }}" {{ $user->id  == $order->borrower_id ? 'selected' : '' }}>{{$user->username}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <br>
            <div class="form-group row" style = "width:80%; margin:auto;">
                <label class="col-sm-12 col-md-2 col-form-label text-blue">Search book</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" id="search" name="search" value="">
                </div>
            </div>
            
            <div class="form-group row">
                <label class="col-sm-12 col-md-3 col-form-label"></label>
                <div class="col-sm-12 col-md-10" style = "width:80%; margin:auto;" >
                    <table class="table table-bordered table-hover">
                        <tbody>
                        
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="form-group row" style = "width:80%; margin:auto; color: red">
                <label class="col-sm-12 col-md-4 col-form-label"><i class="fa fa-exclamation" aria-hidden="true"></i> Click on book to remove</label>
            </div>
            <div class="form-group row" style = "width:80%; margin:auto;">
                <label class="col-sm-12 col-md-2 col-form-label">List book</label>
                <div class="col-sm-12 col-md-10">
                
                    <ul id="listSelectBook">
                        <li>
                        jfjshf
                        </li>
                        <li>
                        jfjshf
                        </li>
                    </ul>
                    
                </div>
            </div>
        </form>					
   </div>
</div>

<script type="text/javascript">
    var selectBookArray = [];
    $(document).ready(function(){
     
     var listSelectBook = document.getElementById('listSelectBook');

    function fetch_data(query = '')
    {
        $.ajax({
        url:"{{ route('orders.search') }}",
        method:'GET',
        data:{query:query},
        dataType:'json',
        success:function(data)
        {
            $('tbody').html(data.table_data);
        }
        })
    }

    function reRenderListBook()
  {
    listSelectMember.innerHTML = "";
    $("#listSelectBook").val('');
    
    selectMemberArray.forEach(function(item, index) {
        selectBookArray.innerHTML =  selectBookArray.innerHTML + "<li class='click_me' index='"+index+"'>book1</li>";
      
      $(".click_me").click(function() {
          var index = $(this).attr('index');
          selectMemberArray.splice(index, 1);
          reRenderListBook();
      });
    
      $("#listSelectBook").val($("#listSelectBook").val() + item.user_id + ",");
    });
    $(document).on('keyup', '#search', function(){
        var query = $(this).val();
        fetch_data(query);
        });
    });

</script>

@endsection