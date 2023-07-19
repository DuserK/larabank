@if ($errors->any())
    <div id="hideMeAfter5Seconds" class = "messages-box">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-10">
                    <div class="w3-container w3-margin alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
