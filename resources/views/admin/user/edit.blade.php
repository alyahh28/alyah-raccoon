@extends('layouts.admin.app')
@section('content')
<div class="py-4">
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item">
                <a href="#">
                    <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                </a>
            </li>
            <li class="breadcrumb-item"><a href="#">User</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit User</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">Edit User</h1>
            <p class="mb-0">Form untuk mengedit data user.</p>
        </div>
        <div>
            <a href="{{ route('user.index') }}" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow components-section">
            <div class="card-body">
                <form action="{{ route('user.update', $dataUser->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <!-- Kolom Kiri -->
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <h5 class="mb-3">Informasi Dasar</h5>

                                <!-- Nama Lengkap -->
                                <div class="mb-3">
                                    <label for="name" class="form-label fw-bold">Nama Lengkap</label>
                                    <input type="text" id="name" class="form-control @error('name') is-invalid @enderror"
                                           name="name" value="{{ old('name', $dataUser->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="mb-3">
                                    <label for="email" class="form-label fw-bold">Email</label>
                                    <input type="email" id="email" class="form-control @error('email') is-invalid @enderror"
                                           name="email" value="{{ old('email', $dataUser->email) }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                         <!-- Role -->
                                <div class="mb-3">
                                    <label for="role" class="form-label">role</label>
                                    <select id="role" name="role" class="form-select">
                                        <option value="">-- Pilih --</option>
                                        <option value="Super Admin">Super Admin</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Mitra">Mitra</option>
                                    </select>
                                </div>

                        <!-- Kolom Kanan -->
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <h5 class="mb-3">Keamanan & Foto Profil</h5>

                                <!-- Password -->
                                <div class="mb-3">
                                    <label for="password" class="form-label fw-bold">Password</label>
                                    <small class="text-muted d-block">(Kosongkan jika tidak ingin mengganti)</small>
                                    <input type="password" id="password" class="form-control @error('password') is-invalid @enderror"
                                           name="password" placeholder="Masukkan password baru">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Konfirmasi Password -->
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label fw-bold">Konfirmasi Password</label>
                                    <input type="password" id="password_confirmation" class="form-control"
                                           name="password_confirmation" placeholder="Konfirmasi password baru">
                                </div>

                                <!-- Foto Profil -->
                                    <div class="mb-4">
                                        <label for="profile_picture" class="form-label fw-bold">Foto Profil</label>
                                        <small class="text-muted d-block">Format: JPG, PNG, JPEG, Maks: 2MB</small>
                                        <input type="file" id="profile_picture" class="form-control @error('profile_picture') is-invalid @enderror"
                                            name="profile_picture" accept="image/jpeg,image/png,image/jpg">
                                        @error('profile_picture')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror

                                    <!-- Preview Foto Profil Saat Ini -->
                                    @if($dataUser->profile_picture && Storage::disk('public')->exists($dataUser->profile_picture))
    <div class="mt-3">
        <p class="text-sm text-muted mb-2">Foto saat ini:</p>
        <div class="d-flex align-items-center gap-3 p-3 bg-light rounded">
            <img src="{{ asset('storage/' . $dataUser->profile_picture) }}"
                 alt="Profile Picture"
                 class="rounded-circle shadow-sm"
                 width="60"
                 height="60"
                 style="object-fit: cover; border: 3px solid #fff;">
            <div>
                <p class="fw-bold mb-1 text-dark">{{ $dataUser->name }}</p>
                <p class="text-muted small mb-0">{{ $dataUser->email }}</p>
            </div>
        </div>
    </div>
@elseif($dataUser->profile_picture)
    <div class="mt-3">
        <p class="text-sm text-muted mb-2">Foto saat ini:</p>
        <div class="alert alert-warning p-3">
            <i class="fas fa-exclamation-triangle me-2"></i>
            File gambar tidak ditemukan
        </div>
    </div>
@endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('user.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times me-1"></i> Batal
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i> Update User
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
