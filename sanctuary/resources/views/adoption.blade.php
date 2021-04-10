@extends('master')
@section('title', 'Adoption')
@section('content')
<!-- <header>
      <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
          <div class="row">
            <div class="col-sm-8 col-md-7 py-4">
              <h4 class="text-white">About</h4>
              <p class="text-muted">Add some information about the album below, the author, or any other background context. Make it a few sentences long so folks can pick up some informative tidbits. Then, link them off to some social networking sites or contact information.</p>
            </div>
            <div class="col-sm-4 offset-md-1 py-4">
              <h4 class="text-white">Contact</h4>
              <ul class="list-unstyled">
                <li><a href="#" class="text-white">Follow on Twitter</a></li>
                <li><a href="#" class="text-white">Like on Facebook</a></li>
                <li><a href="#" class="text-white">Email me</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
          <a href="#" class="navbar-brand d-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
            <strong>Album</strong>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </div>
    </header> -->

    <main role="main">

      <section class="jumbotron text-center">
        <div class="container">
          <h1 class="jumbotron-heading">Animal Sanctuary Adoption</h1>
          <p class="lead text-muted">Save a pet today by simply making an adoption request.</p>
          <p>
            <a href="#" class="btn btn-primary my-2">View adoption requests</a>
            <a href="#" class="btn btn-secondary my-2"></a>
          </p>
        </div>
      </section>

      <div class="album py-5 bg-light">
        <div class="container">

          <div class="row">
            <div class="col-md-4">
              <div class="card mb-4 box-shadow">
                <img class="card-img-top" src="img/catspic.jpeg" alt="Card image cap">
                <div class="card-body">
                  <p class="card-text">Name: Brobby</p> <hr>
                  <p class="card-text">Age: 3</p> <hr>
                  <p class="card-text"> Breed: British Shorthair</p> <hr>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-primary">Adoption Request</button>
                    
                      <button type="button" class="btn btn-sm btn-outline-secondary">Details</button>
                    </div>
                    <small class="text-muted">9 mins</small>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card mb-4 box-shadow">
                <img class="card-img-top" src="img/dog7.jpg" alt="Dog Rusky - German Shepherd">
                <div class="card-body">
                  <p class="card-text">Name: Rusky</p> <hr>
                  <p class="card-text">Age: 9</p> <hr>
                  <p class="card-text"> Breed: German Shepherd</p> <hr>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-primary">Adoption Request</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary">Details</button>
                    </div>
                    <small class="text-muted">15 mins</small>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="card mb-4 box-shadow">
                <img class="card-img-top" src="img/dog6.jpg" alt="Card image cap">
                <div class="card-body">
                  <p class="card-text">Name: Gisley</p> <hr>
                  <p class="card-text">Age: 5</p> <hr>
                  <p class="card-text"> Breed: German Shepherd</p> <hr>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-primary">Adoption Request</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary">Details</button>
                    </div>
                    <small class="text-muted">32 mins</small>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="card mb-4 box-shadow">
                <img class="card-img-top" src="img/cat5.jpg" alt="Card image cap">
                <div class="card-body">
                  <p class="card-text">Name: Lulu</p> <hr>
                  <p class="card-text">Age: 3.5</p> <hr>
                  <p class="card-text"> Breed: Persian Cat</p> <hr>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-primary">Adoption Request</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary">Details</button>
                    </div>
                    <small class="text-muted">56 mins</small>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="card mb-4 box-shadow">
                <img class="card-img-top" src="img/dog1.jpg" alt="Card image cap">
                <div class="card-body">
                  <p class="card-text">Name: Diddy</p> <hr>
                  <p class="card-text">Age: 6</p> <hr>
                  <p class="card-text"> Breed: Pitbull</p> <hr>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-primary">Adoption Request</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary">Details</button>
                    </div>
                    <small class="text-muted">2 hours</small>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="card mb-4 box-shadow">
                <img class="card-img-top" src="img/bengalcat.jpg" alt="Card image cap">
                <div class="card-body">
                  <p class="card-text">Name: Jai</p> <hr>
                  <p class="card-text">Age: 3</p> <hr>
                  <p class="card-text"> Breed: Bengal Cat</p> <hr>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-primary">Adoption Request</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary">Details</button>
                    </div>
                    <small class="text-muted">2.5 hours</small>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="card mb-4 box-shadow">
                <img class="card-img-top" src="img/balinese-cat.jpeg" alt="Card image cap">
                <div class="card-body">
                  <p class="card-text">Name: Poon</p> <hr>
                  <p class="card-text">Age: 1.5</p> <hr>
                  <p class="card-text"> Breed: Balinese Cat</p> <hr>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-primary">Adoption Request</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary">Details</button>
                    </div>
                    <small class="text-muted">6 hours</small>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="card mb-4 box-shadow">
                <img class="card-img-top" src="img/blackbulldog.jpg" alt="Card image cap">
                <div class="card-body">
                  <p class="card-text">Name: Bully</p> <hr>
                  <p class="card-text">Age: 2</p> <hr>
                  <p class="card-text"> Breed: Bulldog</p> <hr>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-primary">Adoption Request</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary">Details</button>
                    </div>
                    <small class="text-muted">24 hours</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </main>
