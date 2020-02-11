<!-- Teams -->
<h6 class="block py-2 px-6 mb-0 text-sm text-greay-dark whitespace-no-wrap">{{ __('teams.teams')}}</h6>

<!-- Create Team -->
@if (Spark::createsAdditionalTeams())
    <a class="block w-full py-1 px-6 font-normal text-grey-darkest whitespace-no-wrap border-0" href="/settings#/{{Spark::teamsPrefix()}}">
        <i class="fa fa-fw text-left fa-btn fa-plus-circle"></i> {{__('teams.create_team')}}
    </a>
@endif

<!-- Switch Current Team -->
@if (Spark::showsTeamSwitcher())
    <a class="block w-full py-1 px-6 font-normal text-grey-darkest whitespace-no-wrap border-0" v-for="team in teams" :href="'/settings/{{ Spark::teamsPrefix() }}/'+ team.id +'/switch'">
        <span v-if="user.current_team_id == team.id">
            <i class="fa fa-fw text-left fa-btn fa-check text-green"></i> @{{ team.name }}
        </span>

        <span v-else>
            <img :src="team.photo_url" class="spark-profile-photo-xs" alt="{{__('Team Photo')}}" /><i class="fa fa-btn"></i> @{{ team.name }}
        </span>
    </a>
@endif

<div class="h-0 my-2 overflow-hidden border-t-1 border-grey-light"></div>
