@extends("auth.layout")

@section("content")
<!-- Section: Design Block -->
<section class="text-center text-lg-start">
  
  <!-- Jumbotron -->
  <div class="container">
    <div class="row g-0 min-vh-100 align-items-center justify-content-center">
      <div class="col-lg-5 mb-5 mb-lg-0">
        <div class="card cascading-right rounded-4" style="
            background: hsla(0, 0%, 100%, 0.55);
            backdrop-filter: blur(30px);
            ">
          <div class="card-body p-5 shadow-5">
            <h2 class="fw-bold mb-5">Welcome Back!</h2>
            <form action="{{route("login")}}" method="POST">
              @csrf
              

              <!-- Email input -->
              <div class="form-outline mb-4">
                <input 
                  type="email"
                  name="email" 
                  class="form-control @error('email') is-invalid @enderror" 
                  placeholder="Email Address *" 
                  required
                  value="{{old("email")}}"
                />
                @error('email') <span class="text-danger">{{$message}}</span> @enderror
              </div>

              <!-- Password input -->
              <div class="form-outline mb-4">
                <input 
                  type="password" 
                  name="password" 
                  class="form-control @error('password') is-invalid @enderror" 
                  placeholder="Password *" 
                  required
                />
                @error('password') <span class="text-danger">{{$message}}</span> @enderror
              </div>

              <!-- Submit button -->
              <button type="submit" class="btn btn-primary btn-block mb-4 px-5 text-uppercase fw-bold">Log in</button>

              <!-- Register buttons -->
              <div class="text-left">
                <p>No account yet? <a href="/signup">Create an account</a></p>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="col-lg-6 mb-lg-0">
        <img src="https://mdbootstrap.com/img/new/ecommerce/vertical/004.jpg" class="w-100 rounded-4 shadow-4 img-fluid" alt="" />
      </div>
    </div>
  </div>
  <!-- Jumbotron -->
</section>
<!-- Section: Design Block -->
@endsection