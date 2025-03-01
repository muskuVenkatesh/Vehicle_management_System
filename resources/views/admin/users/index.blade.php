@extends('layouts.app')

@section('content')
<style>
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

<div class="container">
    <h2 class="text-center mb-4">Manage Users</h2>
    <a href="{{ route('users.create') }}" class="btn btn-success mb-3">Add New User</a>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php $sno = ($users->currentPage() - 1) * $users->perPage() + 1; @endphp
                @foreach ($users as $user)
                <tr>
                    <td>{{ $sno++ }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td><span class="badge bg-info">{{ optional($user->roles)->pluck('name')->join(', ') ?: 'No Role Assigned' }}</span></td>
                    <td>
                        <button class="btn btn-info btn-sm" onclick="showProfile({{ $user->id }}, '{{ $user->name }}')">
                            <i class="fas fa-user"></i> Profile
                        </button>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</a>

                        <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:none;">
                            @csrf
                            @method('DELETE')
                        </form>

                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $user->id }})">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-3">{{ $users->links() }}</div>
</div>

<!-- Profile Modal -->
<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="profileModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="profileDetails">
                    <p class="text-center">Loading...</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function showProfile(userId, userName) {
        document.getElementById('profileModalLabel').textContent = userName + "'s Profile";
        let modalBody = document.getElementById('profileDetails');
        modalBody.innerHTML = `<p class="text-center">Loading...</p>`;

        fetch(`/users/${userId}`)
            .then(response => response.json())
            .then(data => {
                let profileHtml = `
                    <table class="table table-bordered">
                        <tr><th>Name</th><td>${data.name}</td></tr>
                        <tr><th>Email</th><td>${data.email}</td></tr>
                        <tr><th>Role</th><td>${data.roles ? data.roles.join(', ') : 'N/A'}</td></tr>
                    </table>
                `;
                modalBody.innerHTML = profileHtml;

                let profileModal = new bootstrap.Modal(document.getElementById('profileModal'));
                profileModal.show();
            })
            .catch(error => {
                modalBody.innerHTML = `<p class="text-danger">Error loading profile. Please try again.</p>`;
                console.error('Error fetching profile:', error);
            });
    }

    function confirmDelete(userId) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + userId).submit();
            }
        });
    }

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
