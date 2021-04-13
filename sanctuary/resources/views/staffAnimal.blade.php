@extends('layouts.staff_user')
@section('title', 'Animals')
@section('extra-header')
<div class="btn-toolbar mb-2 mb-md-0"> 
    <div class="btn-group mr-2" >
        <button class="btn btn-sm btn-primary" title="Toggle view card">Card</button>
        <button class="btn btn-sm btn-outline-secondary" title="Toggle view table">Table</button>
    </div>
</div> 
@endsection
@section('public-content')
<p>List of all animals.</p>
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
                    <p class="card-text"><b>Availabile:</b> {{$animal['availability'] == 1 ? 'Yes' : 'No'}}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        @if(isset($animal['owner']))
                            <p class="card-text"><b>Owner:</b> {{$animal['owner']}}</p>
                        @endif
                        @if(!isset($animal['owner']))
                            <p class="card-text">&nbsp;</p>
                        @endif                        
                        <small class="text-muted" title="Created at">{{$animal['created_at']}}</small>
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