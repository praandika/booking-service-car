@extends('layouts.app')

@section('hero')
@include('section.hero')
@endsection

@section('content')
@include('section.client')
@if(Auth::check())
    @include('section.cta')
@endif
@include('section.services')
@include('section.pricing')
@include('section.about')
@include('section.contact')
@endsection
