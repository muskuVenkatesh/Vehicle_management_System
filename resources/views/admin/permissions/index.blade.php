@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Manage User, Roles & Permissions</h2>

    <style>
        /* Custom Table Styling */
        .table {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .table th {
            background-color: #007bff;
            color: white;
            text-transform: uppercase;
            padding: 12px;
        }

        .table tbody tr:nth-child(odd) {
            background-color: #f8f9fa;
        }

        .table tbody tr:hover {
            background-color: #e9ecef;
            transition: 0.3s;
        }

        .modal-content {
            border-radius: 10px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>

    <table class="table table-hover mt-3">
        <thead>
            <tr>
                <th>User</th>
                <th>Role</th>
                <th>Permissions</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td><strong>{{ $user->name }}</strong></td>
                <td>
                    <span class="badge bg-info">
                        {{ $user->roles->pluck('name')->join(', ') ?: 'No Role Assigned' }}
                    </span>
                </td>
                <td>
                    @if($user->permissions->isNotEmpty())
                        @foreach($user->permissions as $permission)
                            <span class="badge bg-success">{{ $permission->name }}</span>
                        @endforeach
                    @else
                        <span class="badge bg-secondary">No Permissions Assigned</span>
                    @endif
                </td>
                <td>
                    <!-- Assign Role & Permissions -->
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#assignModal{{ $user->id }}">
                        <i class="fas fa-user-edit"></i> Assign
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="assignModal{{ $user->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title">Assign Role & Permissions</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form action="{{ route('admin.permissions.assign') }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <input type="hidden" name="user_id" value="{{ $user->id }}">

                                        <label class="fw-bold">Role</label>
                                        <select name="role" class="form-control">
                                            <option value="">Select Role</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                                    {{ $role->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <label class="mt-3 fw-bold">Permissions</label>
                                        <div class="form-check">
                                            @foreach ($permissions as $permission)
                                                <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                                    {{ $user->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                                {{ $permission->name }}<br>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-save"></i> Save Changes
                                        </button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            <i class="fas fa-times"></i> Close
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal -->
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

<!-- Include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    @if(session('success'))
        Swal.fire({
            title: "Success!",
            text: "{{ session('success') }}",
            icon: "success",
            timer: 3000,
            showConfirmButton: false
        });
    @endif
</script>

@endsection
