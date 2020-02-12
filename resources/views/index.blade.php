@extends('layouts.blank')
@section('main_container')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h1 class="display-3">
                    Currency Converter
                </h1>
                <h4 id="help" class="text-muted mb-3">Powered by <a href="http://fixer.io" target="_blank">Fixer.io</a></h4>
            </div>
        </div>
    </div>
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="p-4 border-bottom bg-dark">
                <h4 class="card-title mb-0 text-white">Birthday Select</h4>
            </div>
            <div class="card-body">
                <h4 class="text-muted mb-3">Select the date of your last birthday then press the Go button</h4>
                <div class="row no-gutters">
                    <div class="col flex-column">
                        <div class="d-flex align-items-center">
                            <div class="form-group mx-sm-3 mb-2">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-calendar fa-fw fa-2x"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg datepicker" id="birthday" name="birthday" placeholder="Select last birthday" autocomplete="off">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-lg btn-success btn-submit mb-2">Go</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('includes/flash')

    <div class="col-md-12 grid-margin stretch-card">
        <div class="card" id="birthday_rates_card" hidden="true">
            <div class="p-4 border-bottom bg-info">
                <h4 class="card-title mb-0 text-white">Your Birthday Rates: <span id="birthday_date"></span></h4>
            </div>
            <div class="circle-loader" id="birthday_rates_loader" hidden="true"></div>
            <div class="card-body" id="birthday_rates_card_body" hidden="true">
                @include('partials/birthday_rates')
            </div>
        </div>
    </div>

    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="p-4 border-bottom bg-success">
                <h4 class="card-title mb-0 text-white">Conversion History</h4>
            </div>
            <div class="circle-loader" id="conversion_history_loader" hidden="true"></div>
            <div class="card-body table-responsive" id="conversion_history">
                @include('partials/conversion_history')
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">

        $(function(){
            $('input.datepicker').datepicker({
                enableOnReadonly: true,
                todayHighlight: false,
                format: 'dd/mm/yyyy',
                weekStart:1,
                startDate:'-1Y',
                endDate: '-1D',
                autoclose: true
            });
        });

        function getBirthdayRates(){
            var birthday = $("input[name=birthday]").val();
            var birthday_converted = moment(birthday,'DD/MM/YYYY').format('YYYY-MM-DD');
            var url = '{{ route("get-rates", ":birthday") }}';
            url = url.replace(':birthday', birthday_converted);
            $.ajax({
                type:'GET',
                url: url,
            }).done(function(data){
                $('div#flash').prop("hidden", true);
                $('span#birthday_date').html( moment(birthday,'DD/MM/YYYY').format('Do MMMM YYYY'))
                // Set the Birthday Rates section
                $('div#birthday_rates_card').prop("hidden", false);
                $('div#birthday_rates_card_body').prop("hidden", true);
                $('div#birthday_rates_loader').prop("hidden", false);
                $('div#birthday_rates_card_body').html(data);
                // // Set the rates for currency then show the rates section
                // $.each( JSON.parse(data.rates.rates) , function( key, value ) {
                //     $('div#birthday_rates_card_body h4#'+key).html(value);
                // });
                $('div#birthday_rates_loader').prop("hidden", true);
                $('div#birthday_rates_card_body').prop("hidden", false);
                getConversionHistory();

            }).fail(function(e) {
                $('div#birthday_rates_card').prop("hidden", true);
                flash_error(e.status, JSON.parse(e.responseText).message);
            });
        }

        function getConversionHistory(){
            var url = '{{ route("get-history") }}';
            $.ajax({
                type:'GET',
                url: url,
            }).done(function(data){
                $('div#conversion_history').prop("hidden", true);
                $('div#conversion_history_loader').prop("hidden", false);
                $('div#conversion_history').html(data);
                $('div#conversion_history_loader').prop("hidden", true);
                $('div#conversion_history').prop("hidden", false);
            }).fail(function(e) {
                flash_error(e.status, JSON.parse(e.responseText).message);
            })
        }

        function flash_error(error_code, error_message){
            $('div#flash span#error_message').html('There was a problem with your request.' + error_message + '. Error Code:' + error_code);
            $('div#flash').prop("hidden", false);
            setTimeout(function() {
                $('div#flash').prop("hidden", true);
            }, 5000);
        }

        $(".btn-submit").click(function(e){
            e.preventDefault();
            getBirthdayRates();
        });






    </script>

@endpush
