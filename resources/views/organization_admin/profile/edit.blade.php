@extends('organization_admin.layouts.app')

@section('title', 'Edit Profil Organisasi')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Edit Profil Organisasi</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('organization_admin.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama Organisasi</label>
            <input type="text" name="name" class="form-control" value="{{ $organization->name }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control" rows="4">{{ $organization->description }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $organization->email }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nomor Telepon</label>
            <input type="text" name="phone" class="form-control" value="{{ $organization->phone }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Website</label>
            <input type="text" name="website" class="form-control" value="{{ $organization->website }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Logo Organisasi</label>
            @if($organization->logo)
                <img src="{{ $organization->logo }}" class="img-thumbnail d-block mb-2" style="max-height: 100px;">
            @endif
            <input type="file" name="logo" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Banner Organisasi</label>
            @if($organization->banner_image)
                <img src="{{ $organization->banner_image }}" class="img-thumbnail d-block mb-2" style="max-height: 150px;">
            @endif
            <input type="file" name="banner_image" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        <a href="{{ route('organization_admin.dashboard') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
