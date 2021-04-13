@extends('layouts.staff_user')
@section('title', 'Home')
@section('extra-header')
<div class="btn-toolbar mb-2 mb-md-0"> 
    <div class="btn-group mr-2" >
        <button class="btn btn-sm btn-primary" title="Toggle view card">Card</button>
        <button class="btn btn-sm btn-outline-secondary" title="Toggle view table">Table</button>
    </div>
</div> 
@endsection
@section('public-content')
<p>List of pending adoption requests.</p>
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
                            <div class="btn-group" id="{{'btn-group'.$loop->index}}">
                                <button type="button" data-loading-text="Loading..." onclick="acceptAnimalRequest(event, <?=$animal['request_id']?>, '<?='btn-group'.$loop->index?>')" class="btn btn-sm btn-outline-primary">Approve</button>
                                <button type="button" data-loading-text="Loading..." onclick="denyAnimalRequest(event, <?=$animal['request_id']?>, '<?='btn-group'.$loop->index?>')" class="btn btn-sm btn-outline-danger">Deny</button>
                            </div>
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
        function acceptAnimalRequest(evt, request_id, btn_group){
            if(evt !== null){$(evt.target).button('loading')}
            $.ajax({
                url: "<?=route('staff.request_accept')?>",
                type: "post",
                dataType  : 'json',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {'id': request_id} ,
                success: function (response) {
                    if(evt !== null){$(evt.target).button('reset')}
                    if(response.status){
                        $('#'+btn_group).html('<button class="btn btn-sm btn-success">Approved</button>')
                        apiAlertSuccess(response.status)
                    }
                    else{
                        apiAlertError(response?.error || "Failed to approve animal request, please try again.")
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                    if(evt !== null){$(evt.target).button('reset')}
                    apiAlertError(textStatus || "Failed to approve animal request, please try again.")
                }
            });
        }
        function denyAnimalRequest(evt, request_id, btn_group){
            if(evt !== null){$(evt.target).button('loading')}
            $.ajax({
                url: "<?=route('staff.request_deny')?>",
                type: "post",
                dataType  : 'json',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {'id': request_id} ,
                success: function (response) {
                    if(evt !== null){$(evt.target).button('reset')}
                    if(response.status){
                        $('#'+btn_group).html('<button class="btn btn-sm btn-danger">Denied</button>')
                        apiAlertSuccess(response.status)
                    }
                    else{
                        apiAlertError(response?.error || "Failed to deny animal request, please try again.")
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                    if(evt !== null){$(evt.target).button('reset')}
                    apiAlertError(textStatus || "Failed to deny animal request, please try again.")
                }
            });
        }
    </script>
@endif
@endsection