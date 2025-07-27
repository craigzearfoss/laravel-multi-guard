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
                                            <h3 class="mb-1">Edit Admin</h3>

                                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">

                                                <?php /* @include('admin.components.messages', [$errors]) */ ?>

                                                <a class="btn btn-sm btn-solid" href="{{ route('admin.admin.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
                                            </div>

                                        </div>
                                        <div>

                                            <form action="{{ route('admin.admin.update', $admin->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')

                                                <div class="mb-3">
                                                    <label for="username" class="form-label mb-1">User Name</label>
                                                    <input
                                                        type="text"
                                                        name="username"
                                                        value="{{ $admin->username }}"
                                                        class="form-control @error('username') is-invalid @enderror"
                                                        placeholder="User Name"
                                                    >
                                                    @error('username')
                                                        <div class="form-text text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="mb-4">
                                                    <label for="email" class="form-label mb-1">Email</label>
                                                    <input
                                                        type="email"
                                                        name="email"
                                                        value="{{ $user->email }}"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        placeholder="Email"
                                                    >
                                                    @error('email')
                                                        <div class="form-text text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <button type="submit" class="btn btn-sm btn-solid btn-sm"><i class="fa-solid fa-floppy-disk"></i> Update</button>

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
