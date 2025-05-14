@extends('user.layouts.app')

@section('title', 'Daftar Organisasi')

@section('content')
    <div id="org-root"></div>
@endsection

@section('scripts')
    <script>
        console.log('DEBUG: index.blade.php script executed at', new Date().toISOString());
        window.organizationsData = @json($organizations);
        console.log('Organizations index.blade.php loaded');
        console.log('Organizations Data:', window.organizationsData);
    </script>
@endsection