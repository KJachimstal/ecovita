@extends('layouts.default')
@section('title', 'Witamy')

@section('content')
	<div class="album py-5 bg-light">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<div class="card mb-4 box-shadow">
						<img class="card-img-top" src={{ asset('images/badania.jpg') }} alt="Card image cap">
						<div class="card-body">
							<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
							<div class="d-flex justify-content-between align-items-center">
								<div class="btn-group">
									<button type="button" class="btn btn-outline-secondary">View</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card mb-4 box-shadow">
						<img class="card-img-top =" src={{ asset('images/dzieci.jpg') }} alt="Card image cap">
						<div class="card-body">
							<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
							<div class="d-flex justify-content-between align-items-center">
								<div class="btn-group">
									<button type="button" class="btn btn-outline-secondary">View</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card mb-4 box-shadow ">
						<img class="card-img-top" src={{ asset('images/kadra.jpg') }} alt="Card image cap">
						<div class="card-body">
							<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
							<div class="d-flex justify-content-between align-items-center">
								<div class="btn-group">
									<button type="button" class="btn btn-outline-secondary">View</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card mb-4 box-shadow">
						<img class="card-img-top" src={{ asset('images/spec.jpg') }} alt="Card image cap">
						<div class="card-body">
							<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
							<div class="d-flex justify-content-between align-items-center">
								<div class="btn-group">
									<button type="button" class="btn btn-oucatline-secondary">View</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card mb-4 box-shadow">
						<img class="card-img-top" src={{ asset('images/telefon.jpg') }} alt="Card image cap">
						<div class="card-body">
							<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
							<div class="d-flex justify-content-between align-items-center">
								<div class="btn-group">
									<button type="button" class="btn btn-outline-secondary">View</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card mb-4 box-shadow">
						<img class="card-img-top" src={{ asset('images/ubezp.jpg') }} alt="Card image cap">
						<div class="card-body">
							<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
							<div class="d-flex justify-content-between align-items-center">
								<div class="btn-group">
									<button type="button" class="btn btn-outline-secondary">View</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop