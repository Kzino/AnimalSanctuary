@extends('layouts.public_user')
@section('title', 'Home')
@section('extra-header')
<div class="btn-toolbar mb-2 mb-md-0"> 
    <div class="btn-group mr-2" title="Toggle view">
        <a class="btn btn-sm {{$view!='table'?'btn-primary':'btn-outline-secondary'}}" href="{{route('home',['type'=>$type])}}">Card</a>
        <a class="btn btn-sm {{$view=='table'?'btn-primary':'btn-outline-secondary'}}"  href="{{route('home',['type'=>$type??'null', 'view'=>'table'])}}">Table</a>
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

        <!-- if statement if(isset)($view) && $view == &table -->
        @if(isset($view) && $view == 'table')
                    <table id="table" class="w-100"
                        data-show-columns="true">
            </table>
        @else
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
    @endif
</div>
@if(isset($animals) && is_array($animals))
    <script type="application/javascript">
        var animalData = <?=htmlentities(json_encode($animals, JSON_NUMERIC_CHECK), ENT_IGNORE, "UTF-8")?>;


        @if(isset($view) && $view == 'table')

            var $table = $('#table')

            $table.bootstrapTable({data: animalData,  search:"true",
            columns:[
                {field:'name', title:'Name', sortable:true},
                {field:'date_of_birth', title:'Age', sortable:true},
                {field:'type', title:'Type', sortable:true},
                {field:'description', title:'Description'},
                {field: 'image', title:'Image',formatter:function(value,row){
                    let imgvalue = Array.isArray(row.images) && row.images.length >= 1?row.images[0]:null;
                    if(imgvalue !== null) {
                        return '<img class="d-block" style="height:45px; width:45px" src="'+imgvalue.path+'" alt="'+imgvalue.name+'">';
                    } else {
                        return null;
                    }
                }},
                {field: 'created_at', title:'Created At', sortable:true},
                {field: 'actions', title:'Actions', formatter:function(){
                    return '<button type="button" data-loading-text="Loading..." class="btn btn-sm btn-outline-primary adopt_animal">Adopt</button>';
                }, events:{
                    'click .adopt_animal':function(e, value, row, index) {
                        e.preventDefault();
                        adoptAnimalRequest(e, row.id, 'btn-group'+index);
                    }
                }}
            ]})

        @endif
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