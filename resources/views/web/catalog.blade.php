@extends('web.layout.app')

@section('content')
<div class="sample-container-box">
    <div class="sample-container flip-book-container" src="{{ asset('a.pdf') }}" style="height: 500px !important;">
    </div>
</div>
<br /><br /><br />
@endsection

@section('scripts')
<script src="{{ asset('flip/assets/js/three.min.js?ver=108') }}"></script>
<script src="{{ asset('flip/assets/js/pdf.min.js?ver=2.5.207') }}"></script>
<script src="{{ asset('flip/assets/js/3d-flip-book.min.js') }}"></script>
@endsection