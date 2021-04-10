@extends('master')  
@section('title', 'Home')
@section('content')
@extends('navbar') 
   

        <!-- background img -->
        <div>
            <img src="img/catspic.jpeg" class="img-bground">
        </div>    
        <hr>
        <!-- Footer -->
        <footer>
                <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-10 mx-auto">
                    <ul class="list-inline text-center">
                        <li class="list-inline-item">
                        <a href="#">
                            <span class="fa-stack fa-lg">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>
                        </li>
                        <li class="list-inline-item">
                        <a href="#">
                            <span class="fa-stack fa-lg">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>
                        </li>
                        <li class="list-inline-item">
                        <a href="#">
                            <span class="fa-stack fa-lg">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fab fa-instagram fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>
                        </li>
                    </ul>
                    <p class="copyright text-muted">All rights reserved. Animal Sanctuary 2020 &copy;</p>
                    </div>
                </div>
                </div>
        </footer>   

           
@endsection