@if(session()->has('success'))
<div id="hideMeAfter5Seconds" class = "">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-10">
                <div class="w3-container w3-margin alert alert-success" role="alert">
                    {{session()->get('success')}}
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@if(session()->has('info'))
<div id="hideMeAfter5Seconds" class = "">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-10">
                <div class="w3-container w3-margin alert alert-info" role="alert">
                    {{session()->get('info')}}
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@if(session()->has('warning'))
<div id="hideMeAfter5Seconds" class = "">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-10">
                <div class="w3-container w3-margin alert alert-warning" role="alert">
                    {{session()->get('warning')}}
                </div>
            </div>
        </div>
    </div>
</div>
@endif
