<footer class="footer py-4 bg-white">
  <div class="container">
    <div class="row">
      <div class="col-md-6 mt-md-0 mt-3">
        <span class="text-uppercase text-muted">Nasze placówki</span>
        <div class="row mt-2">
          <div class="col-md-6">
            <div class="font-weight-bold">90-051 Łódź</div>
            <div>ul. Piotrkowska 41A</div> 
            <div>Tel: 123-456-789</div>
          </div>
          <div class="col-md-6">
            <div class="font-weight-bold">00-117 Warszawa</div>
            <div>ul. Dynasy 37/2</div> 
            <div>Tel: 123-456-789</div>
          </div>
        </div>
      </div>
      <hr class=" d-md-none ">
      <div class="col-md-6 mb-md-0 mb-3 text-right">
        <span class="text-uppercase text-muted">Odnośniki</span>
        <ul class="list-unstyled mt-2">
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