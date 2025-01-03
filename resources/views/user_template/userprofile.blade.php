@extends('user_template.layouts.user_profile_template')

@section('profilecontent')
<h2>Welcome {{Auth::user()->name}}</h2>


@endsection