@extends('master')
@section('title', 'Addpet')

<form action="/pets/" method="POST" onsubmit="">
    <div class="container">
            <h1>Donate a pet</h1>
            <p>Please fill in this form to add the pet for donation.</p>
            <span class="text-muted">* required field</span>
            <hr>
        <div class="form-group row py-3">
            <label for="name" class="col-sm-2 col-form-label"><b>Pet Name:</b> *</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Enter a pet name">
            </div>
        </div>

        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label"><b>Pet Age: </b>*</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Enter a pet age" required>
            </div>
        </div>
        <div class="row">
                    <div class="col">
                        <label><b>Vaccinated</b></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="vaccinated" id="vaccinated" value="1">
                            <label class="form-check-label" for="vaccinated"><b>Yes</b></label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="vaccinated" id="vaccinated" value="0">
                            <label class="form-check-label" for="vaccinated"><b>No</b></label>
                        </div>
                    </div>
                </div>
    
            <div class="col-4 col-md-4 col-sm-4 cl-lg-4 col-xl-4">
                <div class="row">
                    <div class="col">
                        <label><b>Trained</b></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="trained" id="trained" value="1">
                            <label class="form-check-label" for="trained"><b>Yes</b></label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="trained" id="trained" value="0">
                            <label class="form-check-label" for="trained"><b>No</b></label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4 col-md-4 col-sm-4 cl-lg-4 col-xl-4">
                <div class="row">
                    <div class="col">
                        <label><b>Category</b><span class="text-muted text-danger"> *</span></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="category" id="category" value="cat"
                                required>
                            <label class="form-check-label" for="category"><b>Cat</b></label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="category" id="category" value="dog"
                                required>
                            <label class="form-check-label" for="category"><b>Dog</b></label>
                        </div>
                    </div>
                </div>
            </div>
         <br>

         <div class="form-group row py-3">
            <label for="name" class="col-sm-2 col-form-label"><b>Pet Colour: </b>*</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Enter a pet colour" required>
            </div>
        </div>

        <div class="form-group row py-3">
            <label for="name" class="col-sm-2 col-form-label"><b>Pet Breed: </b>*</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Enter a pet breed" required>
            </div>
        </div>

        <div class="form-group row py-3">
            <label for="name" class="col-sm-2 col-form-label"><b>Pet Location: </b>*</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Enter pet location" required>
            </div>
        </div>

        <div class="form-group row py-3">
            <label for="exampleFormControlTextarea1"><b>Description about pet</b></label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>

        <div class="form-group row py-3">
            <label for="exampleFormControlFile1"><b>Add a pet image</b> *</label>
            <input type="file" class="form-control-file" id="exampleFormControlFile1" required>
        </div>
        <hr>
        <button type="submit" class="btn btn-primary mb-2">Submit</button>

        <button type="submit" class="btn btn-danger mb-2">Cancel</button>


    </div>    

