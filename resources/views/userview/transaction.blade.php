@extends('layouts.userMain')

@push('scripts')
    @vite('resources/js/transaction.js')
@endpush

@section('content')
    <div id="chat"></div>
@endsection
