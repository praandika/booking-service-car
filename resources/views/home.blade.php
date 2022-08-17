@extends('layouts.app')

@section('hero')
@include('section.hero')
@endsection

@section('content')
@include('section.client')
@include('section.cta')
@include('section.services')
@include('section.pricing')
@include('section.about')
@include('section.contact')
@endsection
