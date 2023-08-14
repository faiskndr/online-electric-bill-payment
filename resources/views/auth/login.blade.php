<x-guest-layout title="Login">
  <div class="px-4 py-5 px-md-5 text-center text-lg-start" style="background-color: hsl(0, 0%, 96%)">
    <div class="container">
      <div class="row gx-lg-5 align-items-center">
        <div class="col-lg-6 mb-5 mb-lg-0">
          <h1 class="my-5 display-3 fw-bold ls-tight">
            The best offer <br />
            <span class="text-primary">for your business</span>
          </h1>
          <p style="color: hsl(217, 10%, 50.8%)">
           Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut modi sequi eius nobis maiores deleniti nulla laudantium, voluptatibus, cumque fugit ipsa aliquam inventore vitae animi illo officia alias! Minima, ex! Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perferendis nesciunt dolore maiores quidem minus vitae et dolorem ex necessitatibus possimus repellat harum corporis eligendi nostrum cumque fugiat, illum asperiores accusantium. lor
          </p>
        </div>

        <div class="col-lg-6 mb-5 mb-lg-0">
          <div class="card">
            <div class="card-body py-5 px-md-5">
              @if (\Session::has('fail'))
              <div class="alert alert-danger" role="alert">
                {!! \Session::get('fail') !!}
              </div>
              @endif
              <form method="post" action="{{ route('login') }}">
                @csrf
                <!-- Username input -->
                <div class="form-outline mb-4">
                  <label class="form-label" for="username">Username</label>
                  <input type="text" id="username" class="form-control" name="username"/>
                  <x-input-error :messages="$errors->get('username')" class="mt-2" />
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                  <label class="form-label" for="password">Password</label>
                  <input type="password" id="password" class="form-control" name="password"/>
                  <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-4">
                    login
                </button>

                <!-- Register buttons -->
              </form>
              <div>Belum punya akun? silakan <a href="/register">daftar</a></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-guest-layout>