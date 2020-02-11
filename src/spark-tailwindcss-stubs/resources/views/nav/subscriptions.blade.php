@if (Auth::user()->onTrial())
    <!-- Trial Reminder -->
    <h6 class="block py-2 px-6 mb-0 text-sm text-greay-dark whitespace-no-wrap">{{__('Trial')}}</h6>

    <a class="block w-full py-1 px-6 font-normal text-grey-darkest whitespace-no-wrap border-0" href="/settings#/subscription">
        <i class="fa fa-fw text-left fa-btn fa-shopping-bag"></i> {{__('Subscribe')}}
    </a>

    <div class="h-0 my-2 overflow-hidden border-t-1 border-grey-light"></div>
@endif

@if (Spark::usesTeams() && Auth::user()->ownsCurrentTeam() && Auth::user()->currentTeamOnTrial())
    <!-- Team Trial Reminder -->
    <h6 class="block py-2 px-6 mb-0 text-sm text-greay-dark whitespace-no-wrap">{{__('teams.team_trial')}}</h6>

    <a class="block w-full py-1 px-6 font-normal text-grey-darkest whitespace-no-wrap border-0" href="/settings/{{ Spark::teamsPrefix() }}/{{ Auth::user()->currentTeam()->id }}#/subscription">
        <i class="fa fa-fw text-left fa-btn fa-shopping-bag"></i> {{__('Subscribe')}}
    </a>

    <div class="h-0 my-2 overflow-hidden border-t-1 border-grey-light"></div>
@endif
