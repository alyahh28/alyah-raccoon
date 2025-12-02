@extends('layouts.admin.app')
@section('content')
    <div class="py-4">
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                <li class="breadcrumb-item">
                    <a href="#">
                        <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
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
                                    <th class="border-0 rounded-start">FOTO PROFIL</th>
                                    <th class="border-0">NAMA</th>
                                    <th class="border-0">EMAIL</th>
                                      <th class="border-0 rounded-end">ROLE</th>
                                    <th class="border-0 rounded-end">AKSI</th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($dataUser as $index => $item)
                                    <tr>
                                        <td>
                                            @if ($item->profile_picture && Storage::disk('public')->exists($item->profile_picture))
                                                <img src="{{ asset('storage/' . $item->profile_picture) }}"
                                                    alt="{{ $item->name }}" class="rounded-circle" width="50"
                                                    height="50" style="object-fit: cover;">
                                            @else
                                                <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center"
                                                    style="width: 50px; height: 50px; font-size: 16px;">
                                                    {{ substr($item->name, 0, 1) }}
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="fw-bold">{{ $item->name }}</div>
                                        </td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->role }}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('user.edit', $item->id) }}"
                                                    class="btn btn-sm btn-info d-flex align-items-center">
                                                    <i class="fas fa-edit me-1"></i> Edit
                                                </a>
                                                <form action="{{ route('user.destroy', $item->id) }}" method="POST"
                                                    style="display:inline"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-sm btn-danger d-flex align-items-center">
                                                        <i class="fas fa-trash me-1"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4">
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
        .table th {
            font-weight: 600;
            background-color: #f8f9fa;
            text-transform: uppercase;
            font-size: 0.875rem;
        }

        .table img {
            border-radius: 50%;
        }

        .rounded-circle {
            border-radius: 50% !important;
        }
    </style>
@endsection
