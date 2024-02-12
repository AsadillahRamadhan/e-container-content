@extends('layouts.main')
@section('container')
<div class="row">
    <div class="col-12">
      <div class="card mb-4 px-2">
        <div class="card-header pb-0">
            <div class="d-flex justify-content-end">
                <a href="/e-container-content/users/create" class="btn bg-gradient-success">Tambah Data</a>
            </div>
        </div>
        <form action="/e-container-content/users">
            <div class="form-group mx-4">
                <input type="text" name="q" class="form-control" value="{{ isset($q) ? $q : '' }}" placeholder="Cari Data...">
            </div>
        </form>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Username</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tipe</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                </tr>
              </thead>
              <tbody class="text-center">
                @php 
                $i = $users->firstItem();
                @endphp
                @foreach($users as $u)
                <tr>
                    
                    <td class="align-middle text-xs font-weight-bold mb-0"><b>{{ $i++ }}</b></td>
                    <td class="align-middle text-xs text-secondary mb-0">{{ $u->name }}</td>
                    <td class="align-middle text-xs text-secondary mb-0">{{ $u->username }}</td>
                    <td class="align-middle text-xs text-secondary mb-0">{{ $u->type }}</td>
                    <td class="d-flex items-center justify-content-center align-middle">
                        <form action="/e-container-content/users/{{ $u->id }}" method="POST" id="delete{{ $u->id }}">
                          @csrf
                            @method('delete')
                            <a href="/e-container-content/users/{{ $u->id }}/edit" class="btn bg-gradient-primary btn-xs"><i class="fa-solid fa-edit"></i></a>
                            <button type="button" class="btn bg-gradient-danger btn-xs" data-confirm-delete="true" onclick="deleteForm('delete{{ $u->id }}')"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="d-flex justify-content-end">
        {{ $users->onEachSide(3)->links() }}
    </div>
  </div>

</div>
<style>
small {
    font-size: 10px;
}
</style>
<script>

const deleteForm = (id) => {
  Swal.fire({
  title: "Are you sure?",
  text: "You won't be able to revert this!",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Yes, delete it!"
}).then((result) => {
  if (result.isConfirmed) {
    document.getElementById(id).submit();
  }
});
}

</script>
@endsection