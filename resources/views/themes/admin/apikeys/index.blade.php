@extends(admin_layout('layouts.app'))
@section('content')

<div class="content-wrapper no-print">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{__('admin.api_keys')}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">{{__('admin.home')}}</a></li>
              <li class="breadcrumb-item active">{{__('admin.api_keys')}}</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">{{__('admin.report_description')}}</h3>
                <a class="btn btn-primary btn-sm" style="float: right" href="{{ admin_url('shop_settings/apikeys/create') }}">{{__('admin.add_api_key')}}</a>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover text-center">
                  <thead>
                  <tr>
                    <th>{{__('admin.name')}}</th>
                    <th>{{__('admin.key')}}</th>
                    <th>{{__('admin.scops')}}</th>
                    <th>{{__('admin.status')}}</th>
                    <th>{{__('admin.action')}}</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($keys as $key)
                  <tr class="text-center">
                    <td>{{ $key->name }}</td>
                    <td>
                      <div class="input-group mb-3">
                          <input type="password" 
                                id="api_key_{{ $key->id }}" 
                                class="form-control" 
                                value="{{ $key->key }}" 
                                readonly>

                          <!-- Show / Hide button -->
                          <button type="button" class="btn btn-outline-secondary"
                                  onclick="toggleApiKey('{{ $key->id }}')">
                              <i class="fas fa-eye"></i>
                          </button>

                          <!-- Copy button -->
                          <button type="button" class="btn btn-outline-secondary"
                                  onclick="copyApiKey('{{ $key->id }}')">
                              <i class="fas fa-copy"></i>
                          </button>
                      </div>
          
                    </td>
                    <td>
                      @foreach(json_decode($key->scopes, true) as $scope)
                            @if($scope == 'read')
                                <span class="badge bg-primary">Read</span>
                            @elseif($scope == 'write')
                                <span class="badge bg-warning text-dark">Write</span>
                            @elseif($scope == 'delete')
                                <span class="badge bg-danger">Delete</span>
                            @endif
                        @endforeach
                    </td>
                    <td>{!! api_status($key->active) !!}</td>
                    <td>
                      <form action="{{ admin_url('shop_settings/apikeys/'. $key->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <a href="{{ admin_url('shop_settings/apikeys/'. $key->id.'/edit') }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                  </tr>
                  @endforeach
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

@if (session('remove_br')) 
    <script>
      if(localStorage.getItem('britems')) {
        localStorage.removeItem('britems');
      }

      if(localStorage.getItem('bstudent')) {
        localStorage.removeItem('bstudent');
      }
    </script>
    {{Session::forget('remove_br');}}
@endif


  <script>
function toggleApiKey(id) {
    const input = document.getElementById('api_key_' + id);
    const isPassword = input.type === "password";

    input.type = isPassword ? "text" : "password";
}

function copyApiKey(id) {
    const input = document.getElementById('api_key_' + id);
    navigator.clipboard.writeText(input.value)
        .then(() => {
            Swal.fire({
                icon: 'success',
                title: 'Copied!',
                text: 'API key has been copied.',
                timer: 1200,
                showConfirmButton: false
            });
        })
        .catch(() => alert("Failed to copy."));
}
</script>

  @include('components.modal-lg')
@stop
