<x-guest-layout>
  <div class="px-4 py-5 px-md-5 text-center text-lg-start" style="background-color: hsl(0, 0%, 96%)">
    <div class="container">
      <div class="row gx-lg-5 align-items-center">
        <div class="col-lg-6 mb-5 mb-lg-0">
          <h1 class="my-5 display-3 fw-bold ls-tight">
            The best offer <br />
            <span class="text-primary">for your business</span>
          </h1>
          <p style="color: hsl(217, 10%, 50.8%)">
           
          </p>
        </div>

        <div class="col-lg-6 mb-5 mb-lg-0">
          <div class="card">
            <div class="card-body py-5 px-md-5">
              <form action="{{route('register.store')}}" method="post">
                @csrf
                <!-- 2 column grid layout with text inputs for the first and last names -->
                <div class="row">
                  <div class="col-md-7 mb-4">
                    <div class="form-outline">
                      <label class="form-label" for="nama">Nama</label>
                      <input type="text" id="nama" name="nama_pelanggan" class="form-control" />
                      <x-input-error :messages="$errors->get('nama_pelanggan')" class="mt-2" />
                    </div>
                  </div>
                  <div class="col-md-5 mb-4">
                    <div class="form-outline">
                      <label class="form-label" for="username">Username</label>
                      <input type="text" id="username" name="username" class="form-control" />
                      <x-input-error :messages="$errors->get('username')" class="mt-2" />
                    </div>
                  </div>
                </div>

         
                 
                    <div class="form-outline mb-4">
                      <label class="form-label" for="form3Example3">Nomor Kwh</label>
                      <input type="text" id="form3Example3" class="form-control" name="nomor_kwh" />
                      <x-input-error :messages="$errors->get('nomor_kwh')" class="mt-2" />
                    </div>
                 
               
                    <div class="form-outline mb-4">
                      <label class="form-label" for="daya">Daya</label>
                      <select id="daya" class="form-control" name="daya">
                        <option selected>Pilih Daya</option>
                        @foreach ($tarif as $item)
                          <option value="{{$item->id_tarif}}" >{{$item->daya}}</option>
                        @endforeach
                      </select>
                      <x-input-error :messages="$errors->get('daya')" class="mt-2" />
                  </div>

                  <div class="form-outline mb-4">
                    <label class="form-label" for="alamat">Alamat</label>
                    <input type="text" id="alamat" class="form-control" name="alamat"/>
                    <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
                  </div>
  
                <!-- Password input -->
                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example4">Password</label>
                  <input type="password" id="form3Example4" class="form-control" name="password" />
                  <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                  <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-4">
                  Sign up
                </button>

       
               
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-guest-layout>