@extends('user.landing')

@section('content')
    @include('user.partical.hero')

    @include('user.partical.layanan')

    @include('user.partical.kontenlayanan', ['rumahIbadah' => $rumahIbadah])
    
    @include('user.partical.lacaklayanan')
@endsection
