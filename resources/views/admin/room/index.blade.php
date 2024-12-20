@extends('layouts.adminMain')

@push('styles')
<style type="text/css">

.content-page {

    background-color: #fff !important;
}

.chat-box {

    min-height: 380px !important;
    max-height: 380px !important;
}

input {

    color: black !important;
}

</style>
@endpush

@push('scripts')
    @vite('resources/js/transaction.js')
@endpush

@section('content')
@if (auth()->user()->role != 'superadmin')
    <div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Data Room</h4>
                    </div>
                </div>
            </div>

            <div class="p-3">
                <div id="chat"></div>
            </div>
        </div>
    </div>
@endif
@endsection
