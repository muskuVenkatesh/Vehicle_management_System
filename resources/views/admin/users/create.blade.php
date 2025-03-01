@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg p-4" style="width: 40rem;">
        <h2 class="text-center text-primary">Create New User</h2>

        <div class="modal-body">
            <form id="createUserForm">
                @csrf
                <div class="form-group mb-3">
                    <label class="fw-bold">Name</label>
                    <input type="text" name="name" class="form-control">
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group mb-3">
                    <label class="fw-bold">Email</label>
                    <input type="email" name="email" class="form-control">
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group mb-3">
                    <label class="fw-bold">Phone</label>
                    <input type="tel" name="phone" class="form-control">
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group mb-3">
                    <label class="fw-bold">Password</label>
                    <input type="password" name="password" class="form-control">
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group mb-3">
                    <label class="fw-bold">Role</label>
                    <select name="role" class="form-control">
                        <option value="">Select Role</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback"></div>
                </div>

                <button type="submit" class="btn btn-success w-100 mt-3">Create User</button>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function () {
        $("#createUserForm").submit(function (e) {
            e.preventDefault();

            let formData = $(this).serialize();

            $.ajax({
                url: "{{ route('users.store') }}",
                type: "POST",
                data: formData,
                success: function (response) {
                    Swal.fire({
                        title: "Success!",
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
