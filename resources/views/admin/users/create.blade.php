@extends('admin.layouts.default')

@section('content')

    <div class="app-layout-modern flex flex-auto flex-col">
        <div class="flex flex-auto min-w-0">

            @include('admin.components.nav-left')

            <div class="flex flex-col flex-auto min-h-screen min-w-0 relative w-full bg-white dark:bg-gray-800 border-l border-gray-200 dark:border-gray-700">

                @include('admin.components.header')

                @include('admin.components.popup')

                <div class="page-container relative h-full flex flex-auto flex-col">
                    <div class="h-full">
                        <div class="container mx-auto flex flex-col flex-auto items-center justify-center min-w-0 h-full">
                            <div class="card min-w-[320px] md:min-w-[450px] card-shadow" role="presentation">
                                <div class="card-body md:p-5">
                                    <div class="text-center">
                                        <div class="mb-4">
                                            <h3 class="mb-1">Create User</h3>

                                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">

                                                <?php /* @include('admin.components.messages', [$errors]) */ ?>

                                                <a class="btn btn-sm btn-solid" href="{{ route('admin.users.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
                                            </div>

                                        </div>
                                        <div>

                                            <form action="{{ route('admin.users.store') }}" method="POST">
                                                @csrf

                                                <div class="mb-3">
                                                    <label for="inputName" class="form-label mb-1">Name</label>
                                                    <input
                                                        type="text"
                                                        name="name"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        id="inputName"
                                                        value="{{ old('name') }}"
                                                        placeholder="Name"
                                                    >
                                                    @error('name')
                                                    <div class="form-text text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="inputEmail" class="form-label mb-1">Email</label>
                                                    <input
                                                        type="email"
                                                        name="email"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        id="inputName"
                                                        value="{{ old('email') }}"
                                                        placeholder="Email"
                                                    >
                                                    @error('email')
                                                    <div class="form-text text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="inputPassword" class="form-label mb-1">Password</label>
                                                    <input
                                                        type="password"
                                                        name="password"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        id="inputPassword"
                                                        placeholder="Password"
                                                    >
                                                    @error('password')
                                                    <div class="form-text text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="mb-4">
                                                    <label for="inputConfirmPassword" class="form-label mb-1">Confirm Password</label>
                                                    <input
                                                        type="password"
                                                        name="confirm_password"
                                                        class="form-control @error('confirm_password') is-invalid @enderror"
                                                        id="inputConfirmPassword"
                                                        placeholder="Confirm Password"
                                                    >
                                                    @error('confirm_password')
                                                    <div class="form-text text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <button type="submit" class="btn btn-sm btn-solid"><i class="fa-solid fa-floppy-disk"></i> Submit</button>

                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @include('admin.components.footer')

                </div>
            </div>
        </div>
    </div>

@endsection
