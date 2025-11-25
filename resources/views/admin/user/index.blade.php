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
        </ol>
    </nav>

    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">Data User</h1>
            <p class="mb-0">List data seluruh user</p>
        </div>

        <div>
            <a href="{{ route('user.create') }}" class="btn btn-success">
                <i class="fas fa-plus me-1"></i> Tambah User
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
        <div class="card border-0 shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-centered table-nowrap mb-0 rounded" id="table-user">
                        <thead class="thead-light">
                            <tr>
                                <th class="border-0 rounded-start">#</th>
                                <th class="border-0">Foto Profil</th>
                                <th class="border-0">Nama</th>
                                <th class="border-0">Email</th>
                                <th class="border-0 rounded-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($dataUser as $index => $item)
                                <tr>
                                    <td class="fw-bold">{{ $index + 1 }}</td>
                                    <td>
                                        @if($item->profile_picture)
                                            <img src="{{ Storage::disk('public')->exists($item->profile_picture) ? asset('storage/' . $item->profile_picture) : '/images/default-avatar.png' }}"
                                                 alt="{{ $item->name }}"
                                                 class="rounded-circle"
                                                 width="50"
                                                 height="50"
                                                 style="object-fit: cover; border: 2px solid #e3e6f0;">
                                        @else
                                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                                                 style="width: 50px; height: 50px; font-size: 18px;">
                                                {{ substr($item->name, 0, 1) }}
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="fw-bold">{{ $item->name }}</div>
                                    </td>
                                    <td>{{ $item->email }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('user.edit', $item->id) }}"
                                               class="btn btn-sm btn-info d-flex align-items-center">
                                                <i class="fas fa-edit me-1"></i> Edit
                                            </a>
                                            <form action="{{ route('user.destroy', $item->id) }}"
                                                  method="POST"
                                                  style="display:inline"
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger d-flex align-items-center">
                                                    <i class="fas fa-trash me-1"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="fas fa-users fa-2x mb-3"></i>
                                            <p>Tidak ada data user</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.avatar {
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
}
.table th {
    font-weight: 600;
    background-color: #f8f9fa;
}
.table img {
    border-radius: 50%;
}
</style>
@endsection
