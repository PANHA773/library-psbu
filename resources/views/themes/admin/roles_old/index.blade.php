@extends(admin_layout('layouts.app'))

@section('content')
<div class="content-wrapper no-print">
    <section class="content-header">
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Roles</h3>
            <button type="button" class="btn btn-success float-right" id="createNewRole">Add Role</button>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="roles-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Permissions</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    @foreach($roles  as $role)
                    <tr>
                        <td><?= $i; ?></td>
                        <td>{{$role->name}}</td>
                        <td><?php
                            foreach($role->permissions as $per) {
                                echo '<span class="badge bg-success">'. $per->name.'</span> ';
                            }
                            ?></td>
                       <td class="col-2">
                        <form  action="{{ admin_url('roles/'. $role->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <a href="{{ admin_url('group_book/books/') }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                    </tr>
                    <?php $i++; ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="ajaxRoleModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="roleModalHeading"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{admin_url('roles')}}" name="" class="form-horizontal" method="post">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <input type="hidden" name="role_id" id="role_id">
                    <div class="form-group">
                        <label for="name">Role Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Role Name" required>
                    </div>
                    <div class="form-group">
                        <label>Permissions</label>
                        @foreach(\Spatie\Permission\Models\Permission::all() as $permission)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->name }}" id="perm{{ $permission->name }}">
                            <label class="form-check-label" for="perm{{ $permission->name }}">{{ $permission->name }}</label>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
    </section>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
$(function () {
   


    $('#createNewRole').click(function () {
        $('#saveBtn').val("create-role");
        $('#role_id').val('');
        $('#roleForm').trigger("reset");
        $('#roleModalHeading').html("Create New Role");
        $('#ajaxRoleModal').modal('show');
    });

    

});
</script>
@endsection
