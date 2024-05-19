<style>
.card-hover:hover {
    transform: scale(1.05);
    transition: transform 0.3s ease; /* Add a smooth transition */
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0px solid rgba(0, 0, 0, 0);
    border-radius: .25rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
}
.bg-gradient-scooter {
    background: #17ead9;
    background: -webkit-linear-gradient(
45deg
 , #17ead9, #6078ea)!important;
    background: linear-gradient(
45deg
 , #17ead9, #6078ea)!important;
}
.widgets-icons-2 {
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #ededed;
    font-size: 27px;
    border-radius: 10px;
}
.rounded-circle {
    border-radius: 50%!important;
}
.text-white {
    color: #fff!important;
}
.ms-auto {
    margin-left: auto!important;
}
.bg-gradient-bloody {
    background: #f54ea2;
    background: -webkit-linear-gradient(
45deg
 , #f54ea2, #ff7676)!important;
    background: linear-gradient(
45deg
 , #f54ea2, #ff7676)!important;
}

.bg-gradient-ohhappiness {
    background: #00b09b;
    background: -webkit-linear-gradient(
45deg
 , #00b09b, #96c93d)!important;
    background: linear-gradient(
45deg
 , #00b09b, #96c93d)!important;
}

.bg-gradient-blooker {
    background: #ffdf40;
    background: -webkit-linear-gradient(
45deg
 , #ffdf40, #ff8359)!important;
    background: linear-gradient(
45deg
 , #ffdf40, #ff8359)!important;
}
</style>


<div class="row">
    <div class="col-md-3">
       <div class="card text-white card-hover" style="background-color: #AAB2E1">
           <div class="card-body d-flex align-items-center">
               <img width="50px" src="{{ asset('img/tsales.png') }}" style="color: orange;margin-top: 10px">
               <div class="m-2" style="margin-left: 19px;color: green;font-size: 13px">
                   <p class="card-text">Today Sales</p>
                   <p class="card-text" style="margin-top: -20px"><small>ksh.{{ $todaySales }}.00</small></p>
               </div>
           </div>
       </div>
    </div>
    <div class="col-md-3">
        <a href="{{ route('purchased.index', ['store' => session('selected_store')]) }}">
            <div class="card text-white card-hover" style="background-color: #ffcccc">
                <div class="card-body d-flex align-items-center">
                    <img width="50px" src="{{ asset('img/sell.png') }}" style="color: orange;margin-top: 10px">
                    <div class="m-2" style="margin-left: 19px;color: black;font-size: 13px">
                        <p class="card-text">View Products Sold</p>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="">
            <div class="card text-white card-hover" style="background-color: #fff3cd">
                <div class="card-body d-flex align-items-center">
                    <img width="50px" src="{{ asset('img/report.png') }}" style="color: orange;margin-top: 10px">
                    <div class="m-2" style="margin-left: 19px;color: black;font-size: 13px;margin-top: 6px">
                        <p class="card-text">Print todays invoice</p>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="{{ route('report.index', ['store' => session('selected_store')]) }}">
            <div class="card text-white card-hover" style="background-color: #d9ead3">
                <div class="card-body d-flex align-items-center">
                    <img width="50px" src="{{ asset('img/print.png') }}" style="color: orange;margin-top: 10px">
                    <div class="m-2" style="margin-left: 19px;color: black;font-size: 13px;margin-top: 6px">
                        <p class="card-text">View Reports</p>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>

