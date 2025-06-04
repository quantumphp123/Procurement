@extends('admin.layouts.app')
@section('title', 'Admin - Change Password')

@section('style')
    <style>
        .password-field {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            background: none;
            border: none;
            color: #6c757d;
        }

        .password-toggle:hover {
            color: #495057;
        }
    </style>
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="mb-2 row">
                    <div class="col-sm-6">
                        <h1>Change Password</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Change Password</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Update Password</h3>
                            </div>

                            <form action="{{ route('admin.password.update') }}" method="POST" role="form"
                                id="passwordForm">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="current_password">Current Password</label>
                                        <div class="password-field">
                                            <input type="password"
                                                class="form-control @error('current_password') is-invalid @enderror"
                                                id="current_password" name="current_password" required>
                                            <button type="button" class="password-toggle"
                                                onclick="togglePassword('current_password')">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                        @error('current_password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="new_password">New Password</label>
                                        <div class="password-field">
                                            <input type="password"
                                                class="form-control @error('new_password') is-invalid @enderror"
                                                id="new_password" name="new_password" required>
                                            <button type="button" class="password-toggle"
                                                onclick="togglePassword('new_password')">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                        @error('new_password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="new_password_confirmation">Confirm New Password</label>
                                        <div class="password-field">
                                            <input type="password" class="form-control" id="new_password_confirmation"
                                                name="new_password_confirmation" required>
                                            <button type="button" class="password-toggle"
                                                onclick="togglePassword('new_password_confirmation')">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update Password</button>
                                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#passwordForm').validate({
                rules: {
                    current_password: {
                        required: true,
                        minlength: 8
                    },
                    new_password: {
                        required: true,
                        minlength: 8
                    },
                    new_password_confirmation: {
                        required: true,
                        minlength: 8,
                        equalTo: "#new_password"
                    }
                },
                messages: {
                    current_password: {
                        required: "Please enter your current password",
                        minlength: "Password must be at least 8 characters long"
                    },
                    new_password: {
                        required: "Please enter a new password",
                        minlength: "Password must be at least 8 characters long"
                    },
                    new_password_confirmation: {
                        required: "Please confirm your new password",
                        minlength: "Password must be at least 8 characters long",
                        equalTo: "Passwords do not match"
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });

        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = input.nextElementSibling.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
@endsection
