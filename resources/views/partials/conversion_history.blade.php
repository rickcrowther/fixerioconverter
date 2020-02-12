@if($responses->isNotEmpty())
    <table class="table table-striped">
        <thead>
        <tr class="bg-light rounded">
            <th>Date</th>
            <th class="text-center">British Pound</th>
            <th class="text-center">Japanese Yen</th>
            <th class="text-center">US Dollar</th>
            <th class="text-center">Conversions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($responses as $response)
            @php $rates = json_decode($response->rates);@endphp
            <tr>
                <td>
                    <h4 class="font-weight-semibold text-muted mb-0">{{$response->date->format('jS F Y')}}</h4>
                </td>
                <td class="text-center">
                    <div class="d-inline-flex align-items-centerpx-2 py-2 my-auto text-muted">
                        <i class="fas fa-pound-sign fa-2x fa-fw"></i>
                        <h4 class="font-weight-semibold mb-0">{{$rates->GBP}}</h4>
                    </div>
                </td>
                <td class="text-center">
                    <div class="d-inline-flex align-items-centerpx-2 py-2 my-auto text-muted">
                        <i class="fas fa-yen-sign fa-2x fa-fw"></i>
                        <h4 class="font-weight-semibold mb-0">{{$rates->JPY}}</h4>
                    </div>
                </td>
                <td class="text-center">
                    <div class="d-inline-flex align-items-centerpx-2 py-2 my-auto text-muted">
                        <i class="fas fa-dollar-sign fa-2x fa-fw"></i>
                        <h4 class="font-weight-semibold mb-0">{{$rates->USD}}</h4>
                    </div>
                </td>
                <td class="text-center">
                    <h3 class="font-weight-semibold mb-0"><div class="badge badge-pill badge-primary">{{$response->request_count}}</div></h3>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <h4 class="text-muted mb-3">
        There are no previous conversions to display. Please perform a conversion and it will then display here.
    </h4>
@endif
