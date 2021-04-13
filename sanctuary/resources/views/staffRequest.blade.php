@extends('layouts.staff_user')
@section('title', 'Request')
@section('extra-header')
<div class="btn-toolbar mb-2 mb-md-0"> 
    <div class="btn-group mr-2" >
        <button class="btn btn-sm btn-primary" title="Toggle view card">Card</button>
        <button class="btn btn-sm btn-outline-secondary" title="Toggle view table">Table</button>
    </div>
    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{strtoupper($type ?? 'All types')}}
    </button>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="{{route('staff.request')}}">All types</a>
      <a class="dropdown-item" href="{{route('staff.request',['type'=>'cat'])}}">Cat</a>
      <a class="dropdown-item" href="{{route('staff.request',['type'=>'dog'])}}">Dog</a>
    </div>
</div> 
@endsection
@section('public-content')
<p>List of all adoption request made by users (approved & denied only).</p>
<div class="row">
    @if(isset($animals) && is_array($animals))
        @foreach($animals as $animal)
            <div class="col-md-4">
                <div class="card mb-4 box-shadow">
                    @include('layouts.image_carousel', array('images' => $animal['images'], 'contentid' => $loop->index))
                    <div class="card-body">
                        <p class="card-text"><b>Name:</b> {{$animal['name']}}</p> 
                        <p class="card-text"><b>Age:</b> {{$animal['date_of_birth']}}</p>
                        <p class="card-text"><b>Type:</b> {{ucwords($animal['type'])}}</p>
                        <p class="card-text"><b>Description:</b> {{$animal['description']}}</p>
                        <p class="card-text"><b>Request User:</b> {{$animal['request_user']}}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="card-text"><b>Status:</b> {{ucwords($animal['request_status'])}}</p>
                            <small class="text-muted" title="Created at">{{\Carbon\Carbon::parse($animal['request_created_at'])->diffForhumans()}}</small>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
@if(isset($animals) && is_array($animals))
    <script type="application/javascript">
        var animalData = <?=htmlentities(json_encode($animals, JSON_NUMERIC_CHECK), ENT_IGNORE, "UTF-8")?>;
    </script>
@endif
@endsection