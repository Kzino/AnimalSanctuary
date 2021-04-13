@extends('layouts.public_user')
@section('title', 'Home')
@section('extra-header')
<div class="btn-toolbar mb-2 mb-md-0"> 
    <div class="btn-group mr-2" title="Toggle view">
        <button class="btn btn-sm btn-primary">Card</button>
        <button class="btn btn-sm btn-outline-secondary">Table</button>
    </div>
    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{strtoupper($type ?? 'All types')}}
    </button>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="{{route('home')}}">All types</a>
      <a class="dropdown-item" href="{{route('home',['type'=>'cat'])}}">Cat</a>
      <a class="dropdown-item" href="{{route('home',['type'=>'dog'])}}">Dog</a>
    </div>
</div> 
@endsection
@section('public-content')
<p>List of available animals ready for adoption.</p>
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
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group" id="{{'btn-group'.$loop->index}}">
                                <button type="button" data-loading-text="Loading..." onclick="adoptAnimalRequest(event, <?=$animal['id']?>, '<?='btn-group'.$loop->index?>')" class="btn btn-sm btn-outline-primary">Adopt</button>
                            </div>
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

        function adoptAnimalRequest(evt, animal_id, btn_group){
            if(evt !== null){$(evt.target).button('loading')}
            $.ajax({
                url: "<?=route('request_adopt')?>",
                type: "post",
                dataType  : 'json',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {'id': animal_id} ,
                success: function (response) {
                    if(evt !== null){$(evt.target).button('reset')}
                    if(response.status){
                        $('#'+btn_group).html('<button class="btn btn-sm btn-primary">Pending</button>')
                        apiAlertSuccess(response.status)
                    }
                    else{
                        apiAlertError(response?.error || "Failed to adopt animal, please try again.")
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                    if(evt !== null){$(evt.target).button('reset')}
                    apiAlertError(textStatus || "Failed to adopt animal, please try again.")
                }
            });
        }

    </script>
@endif
@endsection