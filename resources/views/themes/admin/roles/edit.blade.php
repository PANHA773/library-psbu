@extends(admin_layout('layouts.app'))
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{__('admin.edit_role')}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">{{__('admin.home')}}</a></li>
              <li class="breadcrumb-item active">{{__('admin.edit_role')}}</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Please fill in the information below. The field labels marked with * are required input fields.</h3>
              </div>
              <form id="quickForm" action="{{ admin_url('settings/roles/'. $role->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                      <div class="col-md-4">
                          <div class="form-group">
                              <label for="name">{{__('admin.name')}}</label>
                              <input type="text" name="name" class="form-control" id="name" value="{{ $role->name }}"  placeholder="{{__('admin.enter_name')}}" readonly>
                          </div>
                      </div>
                        <div class="col-md-12">
                          <table class="table table-hover table-bordered align-middle">
                             <tbody>
                              @foreach($permissions as $group => $items)
                                      <tr>
                                          <td>{{ ucfirst($group) }}</td>
                                          <td>
                                            @foreach($items as $permission)
                                            <?php $name = explode("-", $permission->name); ?>
                                            <input type="checkbox" class="mx-2" name="permissions[]" value="{{ $permission->name }}" {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}> <span>{{ ucfirst($name[1]) }}</span>
                                            @endforeach
                                          </td>
                                      </tr>
                              @endforeach
                             </tbody>
                          </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">{{__('admin.submit')}}</button>
                </div>
              </form>
            </div>
            </div>
        </div>
      </div>
    </section>
  </div>
</div>

@endsection