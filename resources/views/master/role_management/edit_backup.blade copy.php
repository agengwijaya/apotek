<!-- @extends('layouts.main')

@section('content')
  <section id="content" class="content">
    <div class="content__header content__boxed rounded-0">
      <div class="content__wrap">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="#">Data Master</a></li>
            <li class="breadcrumb-item"><a href="#">Data Edit User Role</a></li>
          </ol>
        </nav>
      </div>
    </div>
    <div class="content__boxed">
      <div class="content__wrap">
        <section>
          <div class="bg-light p-4 rounded">
            <h1>Update role</h1>
            <div class="lead">
              Edit role and manage permissions.
            </div>

            <div class="container mt-4">
              <form method="POST" action="{{ route('roles.update', $role->id) }}">
                @method('patch')
                @csrf
                <div class="row">
                  <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input value="{{ $role->name }}" type="text" class="form-control" name="name" placeholder="Name" required>
                  </div>
                  @php
                    $modul = DB::table('modul')->get();
                  @endphp
                  @foreach ($modul as $m)
                    <div class="col-md-4">
                      <div class="card">
                        <div class="card-body">
                          @php
                            $permission = DB::table('permissions')
                                ->where('id_modul', $m->id)
                                ->get();
                          @endphp

                          <label for="permissions" class="form-label">{{ $m->nama }}</label>

                          <table class="table table-striped">
                            <thead>
                              <th scope="col" width="1%"><input type="checkbox" name="all_permission"></th>
                              <th scope="col" width="20%">Name</th>
                              <th scope="col" width="1%">Guard</th>
                            </thead>

                            @foreach ($permission as $permission)
                              <tr>
                                <td>
                                  <input type="checkbox" name="permission[{{ $permission->name }}]" value="{{ $permission->name }}" class='permission' {{ in_array($permission->name, $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td>{{ $permission->nama_aksi }}</td>
                                <td>{{ $permission->guard_name }}</td>
                              </tr>
                            @endforeach
                          </table>
                        </div>

                      </div>
                    </div>
                  @endforeach
                  <?php
                  // $modul = DB::table('modul')->get();
                  // foreach($modul as $m){
                  //   $permission = DB::table('permissions')->where('id_modul',$m->id)->get();
                  ?>

                  {{-- <div class="col-md-3">
                        <div class="card panel-border-primary">

                          <div class="card-body">
                            <div class="card-title">
                              {{ $m->nama }}
                            </div>
                            <?php foreach($permission as $p){  ?>

                            <li> <input type="checkbox" name="permission[{{ $p->name }}]" value="{{ $p->name }}"> <span>{{ $p->nama_aksi }}</span> </li>
                            <?php } ?>
                          </div>
                        </div>
                      </div> --}}




                  {{-- <?php // } ?> --}}

                </div>



                {{-- @if (count($errors) > 0)
                      <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                          @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                          @endforeach
                        </ul>
                      </div>
                    @endif

                    <form method="POST" action="{{ route('roles.update', $role->id) }}">
                      @method('patch')
                      @csrf
                      <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input value="{{ $role->name }}" type="text" class="form-control" name="name" placeholder="Name" required>
                      </div>

                      <label for="permissions" class="form-label">Assign Permissions</label>

                      <table class="table table-striped">
                        <thead>
                          <th scope="col" width="1%"><input type="checkbox" name="all_permission"></th>
                          <th scope="col" width="20%">Name</th>
                          <th scope="col" width="1%">Guard</th>
                        </thead>

                        @foreach ($permissions as $permission)
                          <tr>
                            <td>
                              <input type="checkbox" name="permission[{{ $permission->name }}]" value="{{ $permission->name }}" class='permission' {{ in_array($permission->name, $rolePermissions) ? 'checked' : '' }}>
                            </td>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->guard_name }}</td>
                          </tr>
                        @endforeach
                      </table>

                      <button type="submit" class="btn btn-primary">Save changes</button>
                      <a href="{{ route('roles.index') }}" class="btn btn-default">Back</a>
                    </form> --}}
                <button type="submit" class="btn btn-primary">Save changes</button>
                <a href="{{ route('roles.index') }}" class="btn btn-default">Back</a>
            </div>
            </form>

          </div>
        </section>
      </div>
    </div>
  </section>

  <script>
    $(function() {
      $('[name="all_permission"]').on('click', function() {

        if ($(this).is(':checked')) {
          $.each($('.permission'), function() {
            $(this).prop('checked', true);
          });
        } else {
          $.each($('.permission'), function() {
            $(this).prop('checked', false);
          });
        }

      });
    })
  </script>
@endsection -->
