<footer class="page-footer font-small blue pt-4">
  <div class="container text-center ">
    <div class="row">
      <div class="col-md-6 mt-md-0 mt-3">
        <h5 class="text-uppercase">Nasze placówki</h5>
         <div class="row">
          <div class="col-md-6">
            <b>90-051 Łódź</b><br>
            ul. Piotrkowska 41A<br>
            Tel: 123-456-789
          </div>
          <div class="col-md-6">
            <b>00-117 Warszawa</b><br>
            ul. Dynasy 37/2<br>
            Tel: 123-456-789
          </div>
         </div>
      </div>
      <hr class=" d-md-none ">
      <div class="col-md-6 mb-md-0 mb-3">
        <h5>ODNOŚNIKI</h5>
        <ul class="list-unstyled">
          <li>
            <a href="/">Strona główna</a>
          </li>
          <li>
            <a href="{{ route('specialities.index') }}">Specjalności</a>
          </li>
          <li>
            <a href="{{ route('users.index') }}">Użytkownicy</a>
          </li>
          <li>
            <a href="{{ route('appointments.index') }}">Wizyty</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="footer-copyright text-center">© 2020 Copyright: Konrad Jachimstal
  </div>
</footer>