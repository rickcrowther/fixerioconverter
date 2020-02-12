@extends('layouts.blank')
@section('main_container')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card" id="birthday_rates_card">
            <div class="p-4 border-bottom bg-info">
                <h4 class="card-title mb-0 text-white">Your Birthday Rates: <span id="birthday_date">{{$date}}</span></h4>
            </div>
            <div class="card-body" id="birthday_rates_card_body">
                @include('partials/birthday_rates')
            </div>
        </div>
    </div>
@endsection
