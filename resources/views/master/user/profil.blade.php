@extends('layouts.main')

@section('content')
  <section id="content" class="content">
    <div class="content__header content__boxed rounded-0">
      <div class="content__wrap">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="#">User</a></li>
            <li class="breadcrumb-item"><a href="#">Profil</a></li>
          </ol>
        </nav>
      </div>
    </div>
    <div class="content__boxed">
      <div class="content__wrap">
        <section>
          <div class="row">
            <div class="col-md-12 mb-3">
              <div class="card h-100">
                <div class="card-body">
                  <form action="{{ url('data-master-user/profil') . '/' . $user->id }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="row">
                      <div class="col-4">
                        <div class="mb-3">
                          <label for="name" class="form-label">Nama Lengkap</label>
                          <input type="text" class="form-control" value="{{ $user->name }}" id="name" name="name" autocomplete="off" required>
                        </div>
                        <div class="mb-3">
                          <label for="username" class="form-label">Username</label>
                          <input type="text" class="form-control" value="{{ $user->username }}" id="username" name="username" autocomplete="off" required>
                        </div>
                        <div class="mb-3">
                          <label for="email" class="form-label">Email</label>
                          <input type="text" class="form-control" value="{{ $user->email }}" id="email" name="email" autocomplete="off" required>
                        </div>
                        <div class="mb-3">
                          <label for="password" class="form-label">Password <small class="text-danger">(kosongi kalau tidak diubah)</small></label>
                          <input type="password" class="form-control" id="password" name="password" autocomplete="off">
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </section>
@endsection
