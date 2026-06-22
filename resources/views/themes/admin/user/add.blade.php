@extends(admin_layout('layouts.app'))
@section('content')

<style>
/* ── Staff Form Styles ── */
.staff-header-card {
    background: linear-gradient(135deg, #1a73e8 0%, #0d47a1 100%);
    border-radius: 12px;
    color: #fff;
    padding: 24px 28px;
    margin-bottom: 24px;
    box-shadow: 0 4px 20px rgba(26,115,232,.35);
}
.staff-header-card h2 { font-size: 1.5rem; font-weight: 700; margin: 0; }
.staff-header-card p  { margin: 4px 0 0; opacity: .85; font-size: .9rem; }

.form-section {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 12px rgba(0,0,0,.08);
    margin-bottom: 24px;
    overflow: hidden;
}
.form-section .section-header {
    background: #f8f9fa;
    border-bottom: 1px solid #e9ecef;
    padding: 14px 20px;
    display: flex;
    align-items: center;
    gap: 10px;
}
.form-section .section-header i {
    color: #1a73e8;
    font-size: 1.1rem;
}
.form-section .section-header span {
    font-weight: 600;
    font-size: .95rem;
    color: #343a40;
}
.form-section .section-body { padding: 20px; }

/* Avatar upload */
.avatar-upload-box {
    border: 2px dashed #c8d8f8;
    border-radius: 10px;
    padding: 20px;
    text-align: center;
    cursor: pointer;
    transition: border-color .2s, background .2s;
    background: #f0f5ff;
}
.avatar-upload-box:hover { border-color: #1a73e8; background: #e3eeff; }
.avatar-preview {
    width: 90px; height: 90px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #1a73e8;
    box-shadow: 0 2px 8px rgba(26,115,232,.3);
    margin: 0 auto 10px;
    display: block;
}
.avatar-upload-box p { color: #6c757d; font-size: .82rem; margin: 0; }
.avatar-upload-box .icon-upload { font-size: 2rem; color: #1a73e8; }

/* Role badge selection */
.role-card {
    border: 2px solid #dee2e6;
    border-radius: 8px;
    padding: 12px 16px;
    cursor: pointer;
    transition: all .2s;
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 8px;
}
.role-card:hover { border-color: #1a73e8; background: #f0f5ff; }
.role-card.selected { border-color: #1a73e8; background: #e3eeff; }
.role-card .role-icon {
    width: 36px; height: 36px;
    border-radius: 50%;
    background: linear-gradient(135deg, #1a73e8, #0d47a1);
    display: flex; align-items: center; justify-content: center;
    color: #fff; flex-shrink: 0;
}
.role-card .role-name { font-weight: 600; font-size: .9rem; color: #343a40; }
.role-card .role-check { margin-left: auto; color: #1a73e8; display: none; }
.role-card.selected .role-check { display: block; }

/* Permission matrix */
#permission-panel { transition: all .3s; }
.perm-group-card {
    background: #f8f9fa;
    border-radius: 8px;
    margin-bottom: 12px;
    overflow: hidden;
    border: 1px solid #e9ecef;
}
.perm-group-header {
    background: #e9ecef;
    padding: 8px 14px;
    font-weight: 600;
    font-size: .85rem;
    color: #495057;
    text-transform: capitalize;
    display: flex;
    align-items: center;
    gap: 6px;
}
.perm-group-header i { color: #1a73e8; }
.perm-chips { padding: 10px 14px; display: flex; flex-wrap: wrap; gap: 6px; }
.perm-chip {
    background: #fff;
    border: 1px solid #c8d8f8;
    color: #1a73e8;
    padding: 3px 10px;
    border-radius: 20px;
    font-size: .78rem;
    font-weight: 500;
}
#permission-panel .no-role-msg {
    text-align: center;
    padding: 30px;
    color: #adb5bd;
    font-size: .9rem;
}
#permission-panel .loading-msg {
    text-align: center;
    padding: 20px;
    color: #1a73e8;
    font-size: .9rem;
}

/* Password strength */
.password-strength-bar { height: 4px; border-radius: 4px; margin-top: 6px; transition: all .3s; }

/* Error alerts */
.field-error { color: #dc3545; font-size: .8rem; margin-top: 3px; }

.btn-submit-staff {
    background: linear-gradient(135deg, #1a73e8, #0d47a1);
    border: none;
    color: #fff;
    padding: 10px 32px;
    border-radius: 6px;
    font-weight: 600;
    font-size: .95rem;
    transition: opacity .2s, box-shadow .2s;
    box-shadow: 0 3px 10px rgba(26,115,232,.4);
}
.btn-submit-staff:hover { opacity: .9; box-shadow: 0 5px 16px rgba(26,115,232,.5); color: #fff; }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{__('admin.add_user')}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">{{__('admin.home')}}</a></li>
                        <li class="breadcrumb-item"><a href="{{ admin_url('peoples/users') }}">{{__('admin.users')}}</a></li>
                        <li class="breadcrumb-item active">{{__('admin.add_user')}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            {{-- Header Banner --}}
            <div class="staff-header-card">
                <h2><i class="fas fa-user-plus mr-2"></i> Create New Staff Account</h2>
                <p>Fill in the staff details, assign a role, and review the granted permissions below.</p>
            </div>

            {{-- Validation Errors --}}
            @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><i class="fas fa-exclamation-triangle mr-1"></i> Please fix the following errors:</strong>
                <ul class="mb-0 mt-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            </div>
            @endif

            <form id="staffForm" action="{{ admin_url('peoples/users') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    {{-- LEFT COLUMN --}}
                    <div class="col-lg-8">

                        {{-- Section: Basic Info --}}
                        <div class="form-section">
                            <div class="section-header">
                                <i class="fas fa-id-card"></i>
                                <span>Basic Information</span>
                            </div>
                            <div class="section-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">{{__('admin.name')}} <span class="text-danger">*</span></label>
                                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                                   id="name" value="{{ old('name') }}"
                                                   placeholder="{{__('admin.enter_your_name')}}">
                                            @error('name')<div class="field-error">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">{{__('admin.email')}} <span class="text-danger">*</span></label>
                                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                                   id="email" value="{{ old('email') }}"
                                                   placeholder="{{__('admin.enter_your_email')}}">
                                            @error('email')<div class="field-error">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone">{{__('admin.phone')}}</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                </div>
                                                <input type="number" name="phone" class="form-control" id="phone"
                                                       value="{{ old('phone') }}" placeholder="{{__('admin.enter_your_phone')}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="gender">{{__('admin.gender')}}</label>
                                            <select class="form-control" id="gender" name="gender">
                                                <option value="male"   {{ old('gender') === 'male'   ? 'selected' : '' }}>{{__('admin.male')}}</option>
                                                <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>{{__('admin.female')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="experience">{{__('admin.experience')}}</label>
                                            <input type="text" name="experience" class="form-control" id="experience"
                                                   value="{{ old('experience') }}" placeholder="{{__('admin.enter_your_experience')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="skills">{{__('admin.skills')}}</label>
                                            <input type="text" name="skills" class="form-control" id="skills"
                                                   value="{{ old('skills') }}" placeholder="{{__('admin.enter_your_skills')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="address">{{__('admin.address')}}</label>
                                            <input type="text" name="address" class="form-control" id="address"
                                                   value="{{ old('address') }}" placeholder="{{__('admin.enter_your_address')}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Section: Password --}}
                        <div class="form-section">
                            <div class="section-header">
                                <i class="fas fa-lock"></i>
                                <span>Password</span>
                            </div>
                            <div class="section-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">{{__('admin.password')}} <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                                       id="password" placeholder="Min. 8 characters">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary toggle-pw" type="button" data-target="#password">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="password-strength-bar mt-1" id="pwBar"></div>
                                            <small class="text-muted" id="pwHint"></small>
                                            @error('password')<div class="field-error">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password_confirmation">{{__('admin.confirm_password')}} <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="password" name="password_confirmation" class="form-control"
                                                       id="password_confirmation" placeholder="Re-enter password">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary toggle-pw" type="button" data-target="#password_confirmation">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <small id="pwMatchHint" class="field-error" style="display:none">Passwords do not match.</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Section: Description --}}
                        <div class="form-section">
                            <div class="section-header">
                                <i class="fas fa-align-left"></i>
                                <span>{{__('admin.description')}}</span>
                            </div>
                            <div class="section-body">
                                <textarea id="summernote" name="description"></textarea>
                            </div>
                        </div>

                    </div>{{-- /LEFT COLUMN --}}

                    {{-- RIGHT COLUMN --}}
                    <div class="col-lg-4">

                        {{-- Section: Avatar --}}
                        <div class="form-section">
                            <div class="section-header">
                                <i class="fas fa-camera"></i>
                                <span>Profile Photo</span>
                            </div>
                            <div class="section-body">
                                <label for="avatar" style="width:100%; cursor:pointer;">
                                    <div class="avatar-upload-box" id="avatarBox">
                                        <img src="{{ asset('images/no_image.png') }}"
                                             id="avatarPreview" class="avatar-preview"
                                             onerror="this.src='{{ asset('images/no_image.png') }}'">
                                        <i class="fas fa-cloud-upload-alt icon-upload"></i>
                                        <p class="mt-1">Click to upload photo<br><span style="font-size:.75rem">JPG, PNG, GIF — max 2 MB</span></p>
                                    </div>
                                </label>
                                <input type="file" name="avatar" id="avatar" class="d-none" accept="image/*">
                            </div>
                        </div>

                        {{-- Section: Role --}}
                        <div class="form-section">
                            <div class="section-header">
                                <i class="fas fa-user-shield"></i>
                                <span>{{__('admin.roles')}} <span class="text-danger">*</span></span>
                            </div>
                            <div class="section-body">
                                <input type="hidden" name="roles" id="rolesHidden" value="">
                                @error('roles')
                                    <div class="alert alert-danger py-1 px-2 mb-2" style="font-size:.82rem">{{ $message }}</div>
                                @enderror

                                @foreach($roles as $role)
                                <div class="role-card" data-role="{{ ucfirst($role->name) }}" data-id="{{ $role->id }}">
                                    <div class="role-icon">
                                        <i class="fas fa-user-tag"></i>
                                    </div>
                                    <div>
                                        <div class="role-name">{{ ucfirst($role->name) }}</div>
                                        <small class="text-muted">Click to assign</small>
                                    </div>
                                    <i class="fas fa-check-circle role-check fa-lg"></i>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Section: Permission Preview --}}
                        <div class="form-section">
                            <div class="section-header">
                                <i class="fas fa-key"></i>
                                <span>Permissions Preview</span>
                            </div>
                            <div class="section-body p-0" id="permission-panel">
                                <div class="no-role-msg">
                                    <i class="fas fa-info-circle fa-2x mb-2 d-block"></i>
                                    Select a role above to preview its permissions.
                                </div>
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <a href="{{ admin_url('peoples/users') }}" class="btn btn-light border">
                                <i class="fas fa-arrow-left mr-1"></i> {{__('admin.back')}}
                            </a>
                            <button type="submit" class="btn-submit-staff">
                                <i class="fas fa-user-plus mr-1"></i> Create Staff
                            </button>
                        </div>

                    </div>{{-- /RIGHT COLUMN --}}
                </div>{{-- /row --}}
            </form>

        </div>
    </section>
</div>

@section('scripts')
<script>
$(function () {

    // ── Avatar preview ──
    $('#avatar').on('change', function () {
        var file = this.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#avatarPreview').attr('src', e.target.result);
            };
            reader.readAsDataURL(file);
        }
    });

    // ── Toggle password visibility ──
    $('.toggle-pw').on('click', function () {
        var $btn   = $(this);
        var target = $btn.data('target');
        var $inp   = $(target);
        var type   = $inp.attr('type') === 'password' ? 'text' : 'password';
        $inp.attr('type', type);
        $btn.find('i').toggleClass('fa-eye fa-eye-slash');
    });

    // ── Password strength ──
    $('#password').on('input', function () {
        var val = $(this).val();
        var bar = $('#pwBar');
        var hint = $('#pwHint');
        if (val.length === 0) { bar.css({width:'0%', background:'#dee2e6'}); hint.text(''); return; }
        var score = 0;
        if (val.length >= 8)  score++;
        if (/[A-Z]/.test(val)) score++;
        if (/[0-9]/.test(val)) score++;
        if (/[^A-Za-z0-9]/.test(val)) score++;
        var colors  = ['#dc3545','#fd7e14','#ffc107','#28a745'];
        var widths  = ['25%','50%','75%','100%'];
        var labels  = ['Weak','Fair','Good','Strong'];
        bar.css({width: widths[score-1] || '0%', background: colors[score-1] || '#dee2e6'});
        hint.text(score > 0 ? labels[score-1] : '').css('color', colors[score-1] || '');
    });

    // ── Password match check ──
    $('#password_confirmation').on('input', function () {
        var match = $(this).val() === $('#password').val();
        $('#pwMatchHint').toggle(!match && $(this).val().length > 0);
    });

    // ── Role card selection ──
    var ajaxUrl = "{{ admin_url('roles') }}";

    $('.role-card').on('click', function () {
        $('.role-card').removeClass('selected');
        $(this).addClass('selected');
        var roleName = $(this).data('role');
        var roleId   = $(this).data('id');
        $('#rolesHidden').val(roleName);
        loadPermissions(roleId);
    });

    // ── Load permissions via AJAX ──
    function loadPermissions(roleId) {
        var $panel = $('#permission-panel');
        $panel.html('<div class="loading-msg"><i class="fas fa-spinner fa-spin mr-1"></i> Loading permissions...</div>');
        $.get("{{ admin_url('roles') }}/" + roleId + "/permissions")
            .done(function (data) {
                if ($.isEmptyObject(data)) {
                    $panel.html('<div class="no-role-msg"><i class="fas fa-ban fa-2x mb-2 d-block"></i>No permissions assigned to this role.</div>');
                    return;
                }
                var html = '<div style="padding:12px;">';
                $.each(data, function (group, perms) {
                    html += '<div class="perm-group-card">';
                    html += '<div class="perm-group-header"><i class="fas fa-layer-group"></i> ' + group + '</div>';
                    html += '<div class="perm-chips">';
                    $.each(perms, function (i, p) {
                        var label = p.name.replace(group + '-', '');
                        html += '<span class="perm-chip"><i class="fas fa-check mr-1" style="font-size:.7rem"></i>' + label + '</span>';
                    });
                    html += '</div></div>';
                });
                html += '</div>';
                $panel.html(html);
            })
            .fail(function () {
                $panel.html('<div class="no-role-msg text-danger"><i class="fas fa-exclamation-triangle"></i> Failed to load permissions.</div>');
            });
    }

    // ── Form submit guard ──
    $('#staffForm').on('submit', function (e) {
        if (!$('#rolesHidden').val()) {
            e.preventDefault();
            Swal.fire({ icon: 'warning', title: 'Role Required', text: 'Please select a role for this staff member.', confirmButtonColor: '#1a73e8' });
            return false;
        }
        if ($('#password').val() !== $('#password_confirmation').val()) {
            e.preventDefault();
            Swal.fire({ icon: 'error', title: 'Password Mismatch', text: 'Passwords do not match.', confirmButtonColor: '#1a73e8' });
            return false;
        }
    });

});
</script>
@endsection

@stop