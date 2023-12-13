@extends('layouts.admin')

@section('section-admin')
    @if (auth()->user()->level == 'admin')
        @include('pages.admin.dashboard.index')
    @elseif (auth()->user()->level == 'owner')
        @include('pages.owner.dashboard.index')
    @endif
@endsection