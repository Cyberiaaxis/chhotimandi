   @extends('Staff.layouts.staff')

   @section('title', 'Dashboard')

   @section('content')
   <div class="container mt-5">
       <h1 class="text-center">Welcome to User Management</h1>

       <div class="text-center mt-4">
           <a href="{{ route('showRegisterForm') }}" class="btn btn-primary btn-lg">Register</a>
           <a href="{{ route('login') }}" class="btn btn-secondary btn-lg">Login</a>
       </div>

       <div class="mt-4 text-center">
           <p>If you already have an account, please log in. If you don't, feel free to register!</p>
       </div>
   </div>
   @endsection