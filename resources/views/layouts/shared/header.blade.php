<nav class="navbar navbar-expand-lg navbar-light bg-white">
  <div class="container">
    <a class="navbar-brand" href="">EcoVita</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
          <a class="nav-link" href="/">Strona główna <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item {{ Request::is('specialities*') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('specialities.index') }}">Specjalności</a>
        </li>
        <li class="nav-item {{ Request::is('users*') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('users.index') }}">Użytkownicy</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Dropdown
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Użytkownicy</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <strong>Zaloguj się</strong>
          </a>
          <ul id="login-dp" class="dropdown-menu p-3">
            <li>
              <div class="row">
                  <div class="col-md-12">
                    Login
                    <form class="form" role="form" method="post" action="login" accept-charset="UTF-8" id="login-nav">
                        <div class="form-group">
                          <label class="sr-only" for="exampleInputEmail2">Adres e-mail</label>
                          <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Adres e-mail" required>
                        </div>
                        <div class="form-group">
                          <label class="sr-only" for="exampleInputPassword2">Hasło</label>
                          <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Hasło" required>
                                                <div class="help-block text-right"><a href="">Zapomniałeś hasła?</a></div>
                        </div>
                        <div class="form-group">
                          <button type="submit" class="btn btn-primary btn-block">Zaloguj</button>
                        </div>
                        <div class="checkbox">
                          <label>
                          <input type="checkbox"> Zostań zalogowany
                          </label>
                        </div>
                    </form>
                  </div>
                  <div class="bottom text-center">
                    <a href="#signup">Zarejestruj się</a>
                  </div>
              </div>
        </li>
      </ul>
    </div>
  </div>
</nav>