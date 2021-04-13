
@if(isset($images) && is_array($images))
<div id="carousel-{{$contentid}}" class="carousel" data-ride="carousel">
  <ol class="carousel-indicators">
    @foreach($images as $image)
        <li data-target="#carousel-{{$contentid}}" data-slide-to="{{$loop->index}}" class="{{$loop->index == 0 ? 'active' : ''}}"></li>
    @endforeach
  </ol>
  <div class="carousel-inner">
    @foreach($images as $image)
        <div class="carousel-item {{$loop->index == 0 ? 'active' : ''}}">
            <img class="d-block w-100" style="height:250px" src="{{$image['path']}}" alt="{{$image['name']}}">
        </div>
    @endforeach
  </div>
  <a class="carousel-control-prev" href="#carousel-{{$contentid}}" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carousel-{{$contentid}}" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
@endif