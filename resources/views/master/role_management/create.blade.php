@extends('layouts.main')

@section('content')
  <section id="content" class="content">
    <div class="content__header content__boxed rounded-0">
      <div class="content__wrap">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="#">Data Master</a></li>
            <li class="breadcrumb-item"><a href="#">Tambah User Role</a></li>
          </ol>
        </nav>
      </div>
    </div>
    <div class="content__boxed">
      <div class="content__wrap">
        <section>
          <div class="bg-light p-4 rounded">
            <div class="lead">
              Tambah User Role
            </div>

            <div class="container mt-4">
              @if (count($errors) > 0)
                <div class="alert alert-danger">
                  <strong>Whoops!</strong> There were some problems with your input.<br><br>
                  <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif

              <form method="POST" action="{{ route('roles.store') }}">
                @csrf
                <div class="row">
                  <div class="col-md-4">
                    <div class="mb-3">
                      <label for="name" class="form-label">Name</label>
                      <input type="text" class="form-control" name="name" placeholder="Name" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  @php
                    $modul = DB::table('module')->get();
                  @endphp
                  @foreach ($modul as $m)
                    <div class="col-md-4 mb-3">
                      <div class="card">
                        <div class="card-body">
                          @php
                            $permission = DB::table('permissions')
                                ->where('module_id', $m->id)
                                ->get();
                          @endphp

                          <label for="permissions" class="form-label">{{ $m->nama }}</label>

                          <table class="table table-striped">
                            <thead>
                              <th scope="col" width="1%"><input type="checkbox" name="all_permission" id="all_permission{{ $m->id }}"></th>
                              <th scope="col" width="20%">Name</th>
                            </thead>

                            @foreach ($permission as $permission)
                              <tr>
                                <td>
                                  <input type="checkbox" name="permission[{{ $permission->name }}]" value="{{ $permission->name }}" class='checkItem{{ $m->id }} permission'>
                                </td>
                                <td>{{ $permission->nama_aksi }}</td>
                              </tr>
                            @endforeach
                          </table>
                        </div>

                      </div>
                    </div>
                    <script>
                      $('#all_permission{{ $m->id }}').click(function() {
                        console.log(1);
                        $(':checkbox.checkItem{{ $m->id }}').prop('checked', this.checked);
                      });
                    </script>
                  @endforeach
                </div>

                <button type="submit" class="btn btn-primary">Tambah</button>
              </form>
            </div>

          </div>
        </section>
      </div>
    </div>
  </section>
@endsection
