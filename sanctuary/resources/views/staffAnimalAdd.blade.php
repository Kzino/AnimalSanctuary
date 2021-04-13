@extends('layouts.staff_user')
@section('title', 'Add Animal')
@section('public-content')
<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('staff.animal_add') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="date_of_birth" class="col-md-4 col-form-label text-md-right">{{ __('Date of birth') }}</label>

                <div class="col-md-6">
                    <input id="date_of_birth" type="date" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{ old('date_of_birth') }}" max="<?=date('Y-m-d')?>" required>

                    @error('date_of_birth')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Type') }}</label>
                <div class="col-md-6">
                    <select id="type" class="form-control @error('type') is-invalid @enderror" name="type" required>
                        @foreach(["cat" => "Cat", "dog" => "Dog"] AS $typeValue => $typeLabel)    
                            <option value="{{ $typeValue }}" {{ old("type") == $typeValue ? "selected" : "" }}>{{ $typeLabel }}</option>
                        @endforeach
                    </select>
                    @error('type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="images" class="col-md-4 col-form-label text-md-right">{{ __('Picture(s)') }}</label>

                <div class="col-md-6">
                    <div class="custom-file">
                        <input id="images" type="file" name="images[]" multiple class="form-control" required accept="image/*">
                        <label class="custom-file-label @error('images') is-invalid @enderror" for="images">Choose file</label>
                    </div>
                    @if ($errors->has('files'))
                            @foreach ($errors->get('files') as $error)
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $error }}</strong>
                            </span>
                        @endforeach
                    @endif
                    @error('images')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                <div class="col-md-6">
                    <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" required rows="3"> </textarea>

                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Add animal') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="application/javascript">
$(document).ready(function($){
   $('.custom-file input').change(function (e) {
        var files = [];
        for (var i = 0; i < $(this)[0].files.length; i++) {
            files.push($(this)[0].files[i].name);
        }
        $(this).next('.custom-file-label').html(files.join(', '));
    });
})
</script>
@endsection