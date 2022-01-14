<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>
                @if(Auth('vendor')->user()->type == "accountant")
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bxs-receipt"></i>
                            <span >Reports</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{route('salesReport')}}">Sales Report</a></li>
                            <li><a href="{{route('statistics')}}">Statistics</a></li>

                        </ul>
                    </li>
                @elseif(Auth('vendor')->user()->type =="operator")
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-dollar-circle"></i>
                            <span >Sales</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li>
                                <a href="{{route('order.index')}}" class="waves-effect">
                                    <span>Orders</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @elseif(Auth('vendor')->user()->type =='driver')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-dollar-circle"></i>
                            <span >Sales</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li>
                                <a href="{{route('order.index')}}" class="waves-effect">
                                    <span>Orders</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @else
                <li>
                    <a href="{{route('vendor.dashboard')}}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">Dashboards</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bxs-food-menu"></i>
                        <span key="t-crypto">Catalog</span>
                    </a>

                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{route('products.index')}}" class="waves-effect">
                                <span >Products</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('addons.index')}}" class="waves-effect">
                                <span>Addons</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('categories.index')}}" class="waves-effect">
                                <span key="t-dashboards">Categories</span>
                            </a>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-dollar-circle"></i>
                        <span >Sales</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{route('order.index')}}" class="waves-effect">
                                <span>Orders</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-bullhorn"></i>

                        <span>Marketing</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{route('promo-codes.index')}}" class="waves-effect">
                                <span >Promo Codes</span>
                            </a>
                        </li>
                        <li><a href="#">Customer Feedback</a></li>
                        <li><a href="#">Abandoned Carts</a></li>

                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bxs-receipt"></i>
                        <span >Reports</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('salesReport')}}">Sales Report</a></li>
                        <li><a href="{{route('statistics')}}">Statistics</a></li>
                        <li><a href="{{route('expiredStock')}}">Expired Stock</a></li>

                    </ul>
                </li>



                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bxs-brightness"></i>
                        <span>Settings</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">

                        <li>
                            <a href="{{route('vendor-users.index')}}" class="waves-effect">
                                <span key="t-dashboards">Users</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{route('branches.index')}}" class="waves-effect">
                                <span >Branches</span>
                            </a>
                        </li>

                        <li><a href="{{route('store-settings.index')}}" key="t-wallet">Store Settings</a></li>
                        <li><a href="{{route('payment-settings.index')}}" key="t-buy">Payment Settings</a></li>
                        <li>
                            <a href="{{route('delivery.index')}}" class="waves-effect">
                                <span >Delivery Zones</span>
                            </a>
                        </li>
                    </ul>
                </li>


                @endif

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
