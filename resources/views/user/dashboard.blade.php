@extends('user.layouts.app')

@section('title', 'Dashboard User')


@section('content')
    <div class="tailwind-wrapper">
        <div id="dashboard-root"></div>
    </div>
@endsection

@section('scripts')
    <script>
        console.log('Dashboard index.blade.php loaded');
        window.dashboardData = @json([]);
    </script>
@endsection