@extends('master')
@section('title', 'Home')
@section('content')
@include('navbar')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    You are normal user.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection