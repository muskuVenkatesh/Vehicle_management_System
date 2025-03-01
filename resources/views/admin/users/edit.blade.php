@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-lg p-4" style="width: 40rem;">
        <h2 class="text-center mb-4">Update {{ $user->name }}</h2>

        <form id="updateUserForm">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label class="fw-bold">Name</label>
                <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
            </div>

            <div class="form-group mb-3">
                <label class="fw-bold">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
            </div>

            <div class="form-group mb-3">
                <label class="fw-bold">Phone</label>
                <input type="phone" name="phone" class="form-control" value="{{ $user->phone }}" required>
            </div>

            <div class="form-group mb-3">
                <label class="fw-bold">Role</label>
                <select name="role" class="form-control" required>
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}" @if($user->roles->contains($role)) selected @endif>
                            {{ ucfirst($role->name) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary w-100 mt-3">Update</button>
        </form>
    </div>
</div>

<!-- Include jQuery and SweetAlert -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function () {
        $("#updateUserForm").submit(function (e) {
            e.preventDefault();

            let formData = $(this).serialize();
            let userId = "{{ $user->id }}";

            $.ajax({
                url: "{{ route('users.update', $user->id) }}",
                type: "PUT",
                data: formData,
                success: function (response) {
                    Swal.fire({
                        title: "Updated!",
                        text: response.message,
                        icon: "success",
                        confirmButtonText: "OK"
                    }).then(() => {
                        window.location.href = "{{ route('users.index') }}";
                    });
                },
                error: function (xhr) {
                    let errors = xhr.responseJSON.errors;
                    let errorMsg = "";

                    $.each(errors, function (key, value) {
                        errorMsg += value + "\n";
                    });

                    Swal.fire({
                        title: "Error!",
                        text: errorMsg,
                        icon: "error",
                        confirmButtonText: "OK"
                    });
                }
            });
        });
    });
</script>

@endsection
