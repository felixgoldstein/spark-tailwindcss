<spark-current-teams :user="user" :teams="teams" inline-template>
    <div>
        <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light card-default">
            <div class="py-3 px-6 mb-0 bg-grey-lighter border-b-1 border-grey-light text-grey-darkest">{{__('teams.current_teams')}}</div>

            <div class="block w-full overflow-auto scrolling-touch">
                <table class="w-full max-w-full mb-4 bg-transparent table-valign-middle mb-0">
                    <thead>
                        <tr>
                            <th class="th-fit"></th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Owner')}}</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr  v-for="team in teams">
                            <!-- Photo -->
                            <td>
                                <img :src="team.photo_url" class="spark-profile-photo" alt="{{__('Team Photo')}}" />
                            </td>

                            <!-- Team Name -->
                            <td>
                                <div>
                                    @{{ team.name }}
                                </div>
                            </td>

                            <!-- Owner Name -->
                            <td>
                                <div>
                                    <span v-if="user.id == team.owner.id">
                                        {{__('You')}}
                                    </span>

                                    <span v-else>
                                        @{{ team.owner.name }}
                                    </span>
                                </div>
                            </td>

                            <!-- Edit Button -->
                            <td class="td-fit">
                                <a :href="'/settings/{{Spark::teamsPrefix()}}/'+team.id">
                                    <button class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-blue-dark border-blue bg-white hover:bg-blue-light hover:text-blue-darker">
                                        <i class="fa fa-cog"></i>
                                    </button>
                                </a>

                                <button class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-yellow-dark border-yellow bg-white hover:bg-yellow-light hover:text-yellow-darker" @click="approveLeavingTeam(team)"
                                        data-toggle="tooltip" title="{{__('teams.leave_team')}}"
                                        v-if="user.id !== team.owner_id">
                                    <i class="fa fa-sign-out"></i>
                                </button>

                                @if (Spark::createsAdditionalTeams())
                                    <button class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-red-dark border-red bg-white hover:bg-red-light hover:text-red-darker" @click="approveTeamDelete(team)" v-if="user.id === team.owner_id">
                                        <i class="fa fa-times"></i>
                                    </button>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Leave Team Modal -->
        <div class="modal" id="modal-leave-team" tabindex="-1" role="dialog">
            <div class="modal-dialog" v-if="leavingTeam">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            {{__('teams.leave_team')}} (@{{ leavingTeam.name }})
                        </h5>
                    </div>

                    <div class="modal-body">
                        {{__('teams.are_you_sure_you_want_to_leave_team')}}
                    </div>

                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline btn-default" data-dismiss="modal">{{__('No, Go Back')}}</button>

                        <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-yellow-lightest bg-yellow hover:bg-yellow-light" @click="leaveTeam" :opacity-75="leaveTeamForm.busy">
                            {{__('Yes, Leave')}}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Team Modal -->
        <div class="modal" id="modal-delete-team" tabindex="-1" role="dialog">
            <div class="modal-dialog" v-if="deletingTeam">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            {{__('teams.delete_team')}}
                        </h5>
                    </div>

                    <div class="modal-body">
                        {{__('teams.are_you_sure_you_want_to_delete_team')}}
                        {{__('teams.if_you_delete_team_all_data_will_be_deleted')}}
                    </div>

                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline btn-default" data-dismiss="modal">{{__('No, Go Back')}}</button>

                        <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-red-lightest bg-red hover:bg-red-light" @click="deleteTeam" :opacity-75="deleteTeamForm.busy">
                            <span v-if="deleteTeamForm.busy">
                                <i class="fa fa-btn fa-spinner fa-spin"></i> {{__('Deleting')}}
                            </span>

                            <span v-else>
                                {{__('Yes, Delete')}}
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</spark-current-teams>
