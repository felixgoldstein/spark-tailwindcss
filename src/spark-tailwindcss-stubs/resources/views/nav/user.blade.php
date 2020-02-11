<!-- NavBar For Authenticated Users -->
<spark-navbar
        :user="user"
        :teams="teams"
        :current-team="currentTeam"
        :unread-announcements-count="unreadAnnouncementsCount"
        :unread-notifications-count="unreadNotificationsCount"
        inline-template>

    <nav class="relative flex flex-wrap items-center content-between py-2 px-4 navbar-light  navbar-spark">
        <div class="container mx-auto" v-if="user">
            <!-- Branding Image -->
            @include('spark::nav.brand')

            <button class="py-1 px-2 text-md leading-normal bg-transparent border border-transparent rounded" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div id="navbarSupportedContent" class="collapse flex-grow items-center">
                <ul class="flex flex-wrap list-reset pl-0 mb-0 mr-auto">
                    @includeIf('spark::nav.user-left')
                </ul>

                <a @click="showNotifications" class="notification-pill mx-auto mb-3 md:mb-0 mr-md-0 md:ml-auto">
                <svg class="mr-2" width="18px" height="20px" viewBox="0 0 18 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <defs>
                        <linearGradient x1="50%" y1="100%" x2="50%" y2="0%" id="linearGradient-1">
                            <stop stop-color="#86A0A6" offset="0%"></stop>
                            <stop stop-color="#596A79" offset="100%"></stop>
                        </linearGradient>
                    </defs>
                    <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g id="header" transform="translate(-926.000000, -29.000000)" fill-rule="nonzero" fill="url(#linearGradient-1)">
                            <g id="Group-3">
                                <path d="M929,37 C929,34.3773361 930.682712,32.1476907 933.027397,31.3318031 C933.009377,31.2238826 933,31.1130364 933,31 C933,29.8954305 933.895431,29 935,29 C936.104569,29 937,29.8954305 937,31 C937,31.1130364 936.990623,31.2238826 936.972603,31.3318031 C939.317288,32.1476907 941,34.3773361 941,37 L941,43 L944,45 L944,46 L926,46 L926,45 L929,43 L929,37 Z M937,47 C937,48.1045695 936.104569,49 935,49 C933.895431,49 933,48.1045695 933,47 L937,47 L937,47 Z"
                                      id="Combined-Shape"></path>
                            </g>
                        </g>
                    </g>
                </svg>
                @{{notificationsCount}}
                </a>

                <ul class="flex flex-wrap list-reset pl-0 mb-0 ml-4">
                    <li class=" relative">
                        <a href="#" class="block md:flex text-center inline-block py-2 px-4 no-underline  inline-block w-0 h-0 ml-1 align border-b-0 border-t-1 border-r-1 border-l-1" id="dropdownMenuButton" data-toggle="relative"
                           aria-haspopup="true" aria-expanded="false">
                            <img :src="user.photo_url" class="dropdown-toggle-image spark-nav-profile-photo" alt="{{__('User Photo')}}" />
                            <span class="hidden md:block">@{{ user.name }}</span>
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

                            <div class="h-0 my-2 overflow-hidden border-t-1 border-grey-light"></div>

                            @if (Spark::usesTeams() && (Spark::createsAdditionalTeams() || Spark::showsTeamSwitcher()))
                                <!-- Team Settings -->
                                @include('spark::nav.teams')
                            @endif

                            @if (Spark::hasSupportAddress())
                                <!-- Support -->
                                @include('spark::nav.support')
                            @endif

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
</spark-navbar>
