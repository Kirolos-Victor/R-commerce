<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="index.html" class="logo logo-light">
                    <span class="logo-lg">
 <img src="{{asset("assets/images/logo/Logo-1.png")}}" alt="" height="50" style="margin-top: 10px;">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>

        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-magnify"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                     aria-labelledby="page-header-search-dropdown">

                    <form class="p-3">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ..."
                                       aria-label="Recipient's username">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if(LaravelLocalization::getCurrentLocaleName() == 'ar')
                        <img id="header-lang-img" src="{{asset("assets/images/flags/egypt.jpg")}}" alt="Header Language"
                             height="16">
                    @else
                        <img id="header-lang-img" src="{{asset("assets/images/flags/us.jpg")}}" alt="Header Language"
                             height="16">
                    @endif
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <!-- item-->
                        <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                           class="dropdown-item notify-item language" data-lang="en" hreflang="{{ $localeCode }}">
                            @if($properties['native'] == 'English')
                                <img src="{{asset("assets/images/flags/us.jpg")}}" alt="user-image" class="me-1"
                                     height="12"> <span class="align-middle"> {{ $properties['native'] }}</span>
                            @else
                                <img src="{{asset("assets/images/flags/egypt.jpg")}}" alt="user-image" class="me-1"
                                     height="12"> <span class="align-middle"> {{ $properties['native'] }}</span>

                            @endif
                        </a>

                    @endforeach

                </div>
            </div>

            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="bx bx-fullscreen"></i>
                </button>
            </div>

            @include('vendor.includes.notifyAreaSec')
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-user font-size-16 align-middle me-1"></i>
                    <span class="d-none d-xl-inline-block ms-1" key="t-henry">{{auth('vendor')->user()->name}}</span>

                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>

                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item d-block" href="#"><i
                            class="bx bx-wrench font-size-16 align-middle me-1"></i> <span key="t-settings">Account Settings</span></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="{{route('vendor.logout')}}"><i
                            class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span
                            key="t-logout">Logout</span></a>
                </div>
            </div>


        </div>
    </div>
</header>
