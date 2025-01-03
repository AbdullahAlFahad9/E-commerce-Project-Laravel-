@extends('user_template.layouts.template')

@section('main-content')
<div class="container">
    <div class="row">
        <!-- First box (navigation) with smaller width -->
        <div class="col-lg-2"> <!-- Adjusted width for smaller size -->
            <div class="box_main">
                <ul>
                    <li><a href="{{ route('home') }}">Dashboard</a></li>
                    <li><a href="{{ route('pendingorder') }}">Pending</a></li>
                    <li><a href="{{ route('history') }}">History</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button type="submit"
                                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Second box (content) takes the remaining space -->
        <div class="col-lg-10"> <!-- Adjusted to take remaining space -->
            <div class="box_main">
                @yield('profilecontent')
            </div>
        </div>
    </div>
</div>
@endsection