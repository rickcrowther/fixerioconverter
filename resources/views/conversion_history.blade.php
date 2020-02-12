@extends('layouts.blank')
@section('main_container')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="p-4 border-bottom bg-success">
                <h4 class="card-title mb-0 text-white">Conversion History</h4>
            </div>
            <div class="card-body table-responsive" id="conversion_history">
                @include('partials/conversion_history')
            </div>
        </div>
    </div>
@endsection
