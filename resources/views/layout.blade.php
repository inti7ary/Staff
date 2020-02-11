<!doctype html>
<html lang="ru">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
    
@section('head')
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>

  <script
  src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
  integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30="
  crossorigin="anonymous"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js" integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    
    <!--js-grid -->
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.css" />
<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid-theme.min.css" />
 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.js"></script>
    @show
    <title>@yield('title')</title>
  </head>
  <body>
   <nav class="navbar navbar-expand-lg navbar-light bg-light">


<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">

      <li class="nav-item active">
        <a class="nav-link" href="{{route('departments')}}">Отделы</a>
      </li>

      <li class="nav-item active">
        <a class="nav-link" href="{{route('employees')}}">Сотрудники</a>
      </li>

      <li class="nav-item active">
        <a class="nav-link" href="{{route('log')}}">Журнал</a>
      </li>

    </ul>
    
    <ul class="navbar-nav ml-auto">
    @guest
    <li class="nav-item active">
        <a class="nav-link" href="{{route('login')}}">Войти</a>
      </li>
    @endguest

    @auth
    <li class="nav-item active">
    <a class="nav-link" onclick="event.preventDefault();
    document.getElementById('logout-form').submit();" href="{{route('logout')}}">Выйти</a>
    <form id="logout-form" action="{{route('logout')}}" method="POST">
        @csrf
    </form>
      </li>
    @endauth
    </ul>
</div>

    </nav>

    <div>
    @section('body')
    <style>
#container{
  font-family: Helvetica, Arial, Verdana, sans-serif;
  font-weight: bold;
  letter-spacing: -1px;
  font-size: 100px;

}

body{
  
  color: #222;
}

#container{
  margin-top: 2.2em;
}

div{
  display: inline-block;
}

#table{
  animation-timing-function: linear;
  animation: table-flip 2s infinite;
  position: relative;
}

.arm{
  animation-timing-function: linear;
  animation: arm-rotate 2s infinite;
  position: relative;
}

@keyframes table-flip {
  0% {  left: 0px; top: 0em; transform: rotate(-180deg);  }
  24% {  top: -2em;  }
  60% { left: 2.5em; top: 0em; transform: rotate(0deg); }
  80% { left: 2.5em; top: 0em; transform: rotate(0deg); }
  100% {  left: 0px; top: 0em; transform: rotate(-180deg);  }
}

@keyframes arm-rotate {
  0% { top: 0.2em; transform: rotate(90deg); }
  20% { top: 0em;transform: rotate(0deg); }
  50% { top: 0em;transform: rotate(0deg); }
  100% { top: 0.2em;transform: rotate(90deg); }
}
    </style>

    <div id="container">
  <div class="guy">
    (<div class="arm">╯</div>°□°）<div class="arm">╯</div>
  </div>
  <div id="table">┻━┻</div>
    <div class="guy">
  </div>
</div>

    @show
    </div>
    
  </body>
</html>
