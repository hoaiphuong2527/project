@extends('admin.masterpage.masterpage')
@section('content')
<div class="row clearfix progress-box">
   <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
      <div class="bg-white pd-20 box-shadow border-radius-5 height-100-p">
         <div class="project-info clearfix">
            <div class="project-info-left">
               <div class="icon box-shadow bg-blue text-white">
                  <i class="fa fa-user"></i>
               </div>
            </div>
            <div class="project-info-right">
               <span class="no text-blue weight-500 font-24">{{ App\Models\User::all()->count() }}</span>
               <p class="weight-400 font-18">Users</p>
            </div>
         </div>
      </div>
   </div>
   <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
      <div class="bg-white pd-20 box-shadow border-radius-5 height-100-p">
         <div class="project-info clearfix">
            <div class="project-info-left">
               <div class="icon box-shadow bg-light-green text-white">
                  <i class="fa fa-book"></i>
               </div>
            </div>
            <div class="project-info-right">
               <span class="no text-light-green weight-500 font-24">{{ App\Models\Book::all()->count() }}</span>
               <p class="weight-400 font-18">Books</p>
            </div>
         </div>
      </div>
   </div>
   <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
      <div class="bg-white pd-20 box-shadow border-radius-5 height-100-p">
         <div class="project-info clearfix">
            <div class="project-info-left">
               <div class="icon box-shadow bg-light-orange text-white">
                  <i class="fa fa-bars"></i>
               </div>
            </div>
            <div class="project-info-right">
               <span class="no text-light-orange weight-500 font-24">{{ App\Models\Category::all()->count() }}</span>
               <p class="weight-400 font-18">Categories</p>
            </div>
         </div>
      </div>
   </div>
   <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
      <div class="bg-white pd-20 box-shadow border-radius-5 margin-5 height-100-p">
         <div class="project-info clearfix">
            <div class="project-info-left">
               <div class="icon box-shadow bg-light-purple text-white">
                  <i class="fa fa-pencil"></i>
               </div>
            </div>
            <div class="project-info-right">
               <span class="no text-light-purple weight-500 font-24">{{ App\Models\Order::all()->count() }}</span>
               <p class="weight-400 font-18">Orders</p>
            </div>
         </div>
      </div>
   </div>
</div>

@endsection