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
            <h2 class="fw-bold mb-4">Create your account</h2>
            <form action="{{route("signup")}}" method="POST">
              @csrf
              <!-- 2 column grid layout with text inputs for the first and last names -->
              <div class="row">
                <div class="col-md-6 mb-4">
                  <div class="form-outline">
                    <input 
                      type="text"
                      name="first_name" 
                      class="form-control @error('first_name') is-invalid @enderror" 
                      placeholder="First Name *" 
                      required
                      value="{{old("first_name")}}"
                    />
                    @error('first_name') <span class="text-danger">{{$message}}</span> @enderror
                  </div>
                </div>
                <div class="col-md-6 mb-4">
                  <div class="form-outline">
                    <input 
                      type="text"
                      name="last_name" 
                      class="form-control @error('last_name') is-invalid @enderror" 
                      placeholder="Last Name *" 
                      required
                      value="{{old("last_name")}}"
                    />
                    @error('last_name') <span class="text-danger">{{$message}}</span> @enderror
                  </div>
                </div>
              </div>

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
              <button type="submit" class="btn btn-primary btn-block mb-4 px-5 text-uppercase fw-bold">Sign up</button>

              <!-- Register buttons -->
              <div class="text-left">
                <p>Already registered? Go to <a href="/login">login</a></p>
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