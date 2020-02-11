<!-- NavBar For Authenticated Users -->
<nav class="relative flex flex-wrap items-center content-between py-2 px-4 navbar-light  navbar-spark">
    <div class="container mx-auto" v-if="user">
        <!-- Branding Image -->
        @include('spark::nav.brand')

        <button class="py-1 px-2 text-md leading-normal bg-transparent border border-transparent rounded" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div id="navbarSupportedContent" class="collapse flex-grow items-center">
            <!-- Left Side Of Navbar -->
            <ul class="flex flex-wrap list-reset pl-0 mb-0 mr-auto">
                @includeIf('spark::nav.user-left')
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="flex flex-wrap list-reset pl-0 mb-0 ml-4">
                <li class=" relative">
                    <!-- User Photo / Name -->
                    <a href="#" class="block md:flex text-center inline-block py-2 px-4 no-underline  inline-block w-0 h-0 ml-1 align border-b-0 border-t-1 border-r-1 border-l-1" id="dropdownMenuButton" data-toggle="relative"
                       aria-haspopup="true" aria-expanded="false">
                        <img src="{{ Auth::user()->photo_url }}" class="dropdown-toggle-image spark-nav-profile-photo" alt="{{__('User Photo')}}" />
                        <span class="hidden md:block">{{ auth()->user()->name }}</span>
                    </a>

                    <div class=" absolute pin-l z-50 float-left hidden list-reset	 py-2 mt-1 text-base bg-white border border-grey-light rounded dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <!-- Impersonation -->
                        @if (session('spark:impersonator'))
                            <h6 class="block py-2 px-6 mb-0 text-sm text-greay-dark whitespace-no-wrap">{{__('Impersonation')}}</h6>

                            <!-- Stop Impersonating -->
                            <a class="block w-full py-1 px-6 font-normal text-grey-darkest whitespace-no-wrap border-0" href="/spark/kiosk/users/stop-impersonating">
                                <i class="fa fa-fw text-left fa-btn fa-user-secret"></i> {{__('Back To My Account')}}
                            </a>

                            <div class="h-0 my-2 overflow-hidden border-t-1 border-grey-light"></div>
                        @endif

                        <!-- Developer -->
                        @if (Spark::developer(Auth::user()->email))
                            @include('spark::nav.developer')
                        @endif

                        <!-- Subscription Reminders -->
                        @include('spark::nav.subscriptions')

                        <!-- Settings -->
                        <h6 class="block py-2 px-6 mb-0 text-sm text-greay-dark whitespace-no-wrap">{{__('Settings')}}</h6>

                        <!-- Your Settings -->
                        <a class="block w-full py-1 px-6 font-normal text-grey-darkest whitespace-no-wrap border-0" href="/settings">
                            <i class="fa fa-fw text-left fa-btn fa-cog"></i> {{__('Your Settings')}}
                        </a>

                        @if (Spark::usesTeams() && (Spark::createsAdditionalTeams() || Spark::showsTeamSwitcher()))
                            <!-- Team Settings -->
                            @include('spark::nav.blade.teams')
                        @endif

                        <div class="h-0 my-2 overflow-hidden border-t-1 border-grey-light"></div>

                        <!-- Logout -->
                        <a class="block w-full py-1 px-6 font-normal text-grey-darkest whitespace-no-wrap border-0" href="/logout">
                            <i class="fa fa-fw text-left fa-btn fa-sign-out"></i> {{__('Logout')}}
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
