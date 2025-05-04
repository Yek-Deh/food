@extends('admin.dashboard')
@section('admin_content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        .form-check-label {
            text-transform: capitalize;
        }
    </style>
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Role In Permission</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Add Role In Permission</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-xl-9 col-lg-8">
                    <div class="card">
                        <div class="card-body p-4">
                            @if(!$roles->isEmpty())
                                <form id="myForm" action="{{ route('role.permission.store') }}" method="post"
                                      enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div>

                                                <div class="form-group mb-3">
                                                    <label for="example-text-input" class="form-label">Roles
                                                        Name </label>
                                                    <select name="role_id" class="form-select">
                                                        <option selected disabled>Select Roles</option>
                                                        @foreach ($roles as $role)
                                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-check mb-3">
                                                    <input class="form-check-input" type="checkbox" id="formCheck1">
                                                    <label class="form-check-label" for="formCheck1">
                                                        Permission All
                                                    </label>
                                                </div>
                                                <hr>
                                                @foreach ($permission_groups as $group)
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <div class="form-check mb-3">
                                                                <input class="form-check-input group-checkbox"
                                                                       type="checkbox"
                                                                       id="groupCheckbox{{ $loop->iteration }}"
                                                                       data-group="{{ $loop->iteration }}">
                                                                <label class="form-check-label"
                                                                       for="groupCheckbox{{ $loop->iteration }}">
                                                                    {{ $group->group_name }}
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="col-9">
                                                            @php
                                                                $permissions = App\Models\Admin::getPermissionByGroupName($group->group_name);
                                                            @endphp

                                                            @foreach ($permissions as $permission)
                                                                <div class="form-check mb-3">
                                                                    <input class="form-check-input permission-checkbox"
                                                                           name="permission[]"
                                                                           value="{{ $permission->id }}"
                                                                           type="checkbox"
                                                                           id="permissionCheckbox{{ $permission->id }}"
                                                                           data-group="{{ $loop->parent->iteration }}">
                                                                    <label class="form-check-label"
                                                                           for="permissionCheckbox{{ $permission->id }}">
                                                                        {{ $permission->name }}
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                            <br>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <div class="mt-4 text-center">
                                                    <button type="submit"
                                                            class="btn btn-primary waves-effect waves-light">
                                                        Save Changes
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @else
                                <h5 class="text-center alert alert-info">All Roles Take Permissions</h5>
                            @endif
                        </div>
                    </div>
                    <!-- end tab content -->
                </div>
                <!-- end col -->


                <!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#myForm').validate({
                rules: {
                    role_id: {
                        required: true,
                    },

                },
                messages: {
                    role_id: {
                        required: 'Please Choose Role',
                    },

                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });

    </script>
    <script type="text/javascript">
        $(document).ready(function () {

            $('#myForm').on('submit', function (e) {
                let isChecked = false;

                // Loop over all checkboxes with names starting with "category"
                $('[name^="permission"]').each(function () {
                    if ($(this).is(':checked')) {
                        isChecked = true;
                        return false; // break loop
                    }
                });

                // If none checked, prevent form submit and show error
                if (!isChecked) {
                    e.preventDefault();
                    // Remove old error
                    $('#category-error').remove();
                    // Append new error message
                    $('[name^="permission"]').last().closest('.row').after(
                        '<span id="category-error" class="text-danger">Please select at least one permission category.</span>'
                    );
                } else {
                    $('#category-error').remove(); // clean up if valid
                }
            });
        });
    </script>
    <script>
        $('#formCheck1').click(function () {
            if ($(this).is(':checked')) {
                $('input[ type=checkbox]').prop('checked', true)
            } else {
                $('input[ type=checkbox]').prop('checked', false)
            }
        })
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const groupCheckboxes = document.querySelectorAll('.group-checkbox');

            groupCheckboxes.forEach(groupCheckbox => {
                groupCheckbox.addEventListener('change', function () {
                    const groupId = this.getAttribute('data-group');
                    const permissions = document.querySelectorAll(`.permission-checkbox[data-group='${groupId}']`);

                    permissions.forEach(permissionCheckbox => {
                        permissionCheckbox.checked = this.checked;
                    });
                });
            });
        });
    </script>
@endsection
