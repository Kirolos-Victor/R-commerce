<style>
    .bell{
       /* display:block;
        width: 40px;
        height: 40px;
        font-size: 40px;
        margin:50px auto 0;
        color: #9e9e9e;*/
        font-size: 60px !important;
        -webkit-animation: ring 4s .7s ease-in-out infinite;
        -webkit-transform-origin: 50% 4px;
        -moz-animation: ring 4s .7s ease-in-out infinite;
        -moz-transform-origin: 50% 4px;
        animation: ring 4s .7s ease-in-out infinite;
        transform-origin: 50% 4px;
    }

    @-webkit-keyframes ring {
        0% { -webkit-transform: rotateZ(0); }
        1% { -webkit-transform: rotateZ(30deg); }
        3% { -webkit-transform: rotateZ(-28deg); }
        5% { -webkit-transform: rotateZ(34deg); }
        7% { -webkit-transform: rotateZ(-32deg); }
        9% { -webkit-transform: rotateZ(30deg); }
        11% { -webkit-transform: rotateZ(-28deg); }
        13% { -webkit-transform: rotateZ(26deg); }
        15% { -webkit-transform: rotateZ(-24deg); }
        17% { -webkit-transform: rotateZ(22deg); }
        19% { -webkit-transform: rotateZ(-20deg); }
        21% { -webkit-transform: rotateZ(18deg); }
        23% { -webkit-transform: rotateZ(-16deg); }
        25% { -webkit-transform: rotateZ(14deg); }
        27% { -webkit-transform: rotateZ(-12deg); }
        29% { -webkit-transform: rotateZ(10deg); }
        31% { -webkit-transform: rotateZ(-8deg); }
        33% { -webkit-transform: rotateZ(6deg); }
        35% { -webkit-transform: rotateZ(-4deg); }
        37% { -webkit-transform: rotateZ(2deg); }
        39% { -webkit-transform: rotateZ(-1deg); }
        41% { -webkit-transform: rotateZ(1deg); }

        43% { -webkit-transform: rotateZ(0); }
        100% { -webkit-transform: rotateZ(0); }
    }

    @-moz-keyframes ring {
        0% { -moz-transform: rotate(0); }
        1% { -moz-transform: rotate(30deg); }
        3% { -moz-transform: rotate(-28deg); }
        5% { -moz-transform: rotate(34deg); }
        7% { -moz-transform: rotate(-32deg); }
        9% { -moz-transform: rotate(30deg); }
        11% { -moz-transform: rotate(-28deg); }
        13% { -moz-transform: rotate(26deg); }
        15% { -moz-transform: rotate(-24deg); }
        17% { -moz-transform: rotate(22deg); }
        19% { -moz-transform: rotate(-20deg); }
        21% { -moz-transform: rotate(18deg); }
        23% { -moz-transform: rotate(-16deg); }
        25% { -moz-transform: rotate(14deg); }
        27% { -moz-transform: rotate(-12deg); }
        29% { -moz-transform: rotate(10deg); }
        31% { -moz-transform: rotate(-8deg); }
        33% { -moz-transform: rotate(6deg); }
        35% { -moz-transform: rotate(-4deg); }
        37% { -moz-transform: rotate(2deg); }
        39% { -moz-transform: rotate(-1deg); }
        41% { -moz-transform: rotate(1deg); }

        43% { -moz-transform: rotate(0); }
        100% { -moz-transform: rotate(0); }
    }

    @keyframes ring {
        0% { transform: rotate(0); }
        1% { transform: rotate(30deg); }
        3% { transform: rotate(-28deg); }
        5% { transform: rotate(34deg); }
        7% { transform: rotate(-32deg); }
        9% { transform: rotate(30deg); }
        11% { transform: rotate(-28deg); }
        13% { transform: rotate(26deg); }
        15% { transform: rotate(-24deg); }
        17% { transform: rotate(22deg); }
        19% { transform: rotate(-20deg); }
        21% { transform: rotate(18deg); }
        23% { transform: rotate(-16deg); }
        25% { transform: rotate(14deg); }
        27% { transform: rotate(-12deg); }
        29% { transform: rotate(10deg); }
        31% { transform: rotate(-8deg); }
        33% { transform: rotate(6deg); }
        35% { transform: rotate(-4deg); }
        37% { transform: rotate(2deg); }
        39% { transform: rotate(-1deg); }
        41% { transform: rotate(1deg); }

        43% { transform: rotate(0); }
        100% { transform: rotate(0); }
    }
</style>
<div class="dropdown d-inline-block" id="notifyAreaSec">
    <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="bell bx bx-bell  <!--bx-tada-->"></i>
        <span class="badge bg-danger rounded-pill">{{count($notificationsNewOrders)}}</span>
    </button>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
         aria-labelledby="page-header-notifications-dropdown">
        <div class="p-3">
            <div class="row align-items-center">
                <div class="col">
                    <h6 class="m-0" key="t-notifications"> Notifications </h6>
                </div>
     {{--  <div class="col-auto">
                           <a href="#!" class="small" key="t-view-all"> View All</a>
                       </div>--}}

            </div>
        </div>
        <div data-simplebar style="max-height: 230px;">
                @foreach($notificationsNewOrders as $order)
                    <a href="{{route('vendor.orderDetail',['id'=>$order->id])}}" class="text-reset notification-item">
                        <div class="d-flex">
                            <div class="avatar-xs me-3">
                                                <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                    <i class="bx bx-cart"></i>
                                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1" key="t-your-order">{{strtoupper($order->status)}}</h6>
                                <div class="font-size-12 text-muted">
                                    <p class="mb-1" key="t-grammer">{{'Order NO : ' .$order->id}}</p>
                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span key="t-min-ago">{{$order->created_at}}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
        </div>
  {{-- <div class="p-2 border-top d-grid">
               <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                   <i class="mdi mdi-arrow-right-circle me-1"></i> <span key="t-view-more">View More..</span>
               </a>
           </div>--}}

    </div>
</div>
