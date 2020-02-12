@if($rates)
    <div class="row">
        <div class="col d-flex">
            <div class="d-inline-flex align-items-center justify-content-center px-2 py-2 my-auto text-muted">
                <i class="fas fa-euro-sign fa-2x fa-fw"></i>
            </div>
            <div class="wrapper pl-3">
                <p class="mb-0 font-weight-medium text-muted">Base Currency</p>
                <h4 class="font-weight-semibold mb-0">1 Euro</h4>
            </div>
        </div>
        @if(isset(json_decode($rates->rates)->GBP))
            <div class="col d-flex">
                <div class="d-inline-flex align-items-center justify-content-center px-2 py-2 my-auto text-muted">
                    <i class="fas fa-pound-sign fa-2x fa-fw"></i>
                </div>
                <div class="wrapper pl-3">
                    <p class="mb-0 font-weight-medium text-muted">British Pound</p>
                    <h4 class="font-weight-semibold mb-0" id="GBP">{{json_decode($rates->rates)->GBP}}</h4>
                </div>
            </div>
        @endif
        @if(isset(json_decode($rates->rates)->JPY))
            <div class="col d-flex">
                <div class="d-inline-flex align-items-center justify-content-center px-2 py-2 my-auto text-muted">
                    <i class="fas fa-yen-sign fa-2x fa-fw"></i>
                </div>
                <div class="wrapper pl-3">
                    <p class="mb-0 font-weight-medium text-muted">Japanese Yen</p>
                    <h4 class="font-weight-semibold mb-0" id="JPY">{{json_decode($rates->rates)->JPY}}</h4>
                </div>
            </div>
        @endif
        @if(isset(json_decode($rates->rates)->USD))
            <div class="col d-flex">
                <div class="d-inline-flex align-items-center justify-content-center px-2 py-2 my-auto text-muted">
                    <i class="fas fa-dollar-sign fa-2x fa-fw"></i>
                </div>
                <div class="wrapper pl-3">
                    <p class="mb-0 font-weight-medium text-muted">US Dollar</p>
                    <h4 class="font-weight-semibold mb-0" id="USD">{{json_decode($rates->rates)->USD}}</h4>
                </div>
            </div>
        @endif
    </div>
@endif
