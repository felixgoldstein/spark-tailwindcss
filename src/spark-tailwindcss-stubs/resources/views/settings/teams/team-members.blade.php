<spark-team-members :user="user" :team="team" inline-template>
    <div>
        <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light card-default">
            <div class="py-3 px-6 mb-0 bg-grey-lighter border-b-1 border-grey-light text-grey-darkest">
                {{__('teams.team_members')}} (@{{ team.users.length }})
            </div>

            <div class="block w-full overflow-auto scrolling-touch">
                <table class="w-full max-w-full mb-4 bg-transparent table-valign-middle mb-0">
                    <thead>
                        <tr>
                            <th class="th-fit"></th>
                            <th>{{__('Name')}}</th>
                            <th v-if="roles.length > 1">{{__('Role')}}</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="member in team.users" :key="member.id">
                            <!-- Photo -->
                            <td>
                                <img :src="member.photo_url" class="spark-profile-photo" alt="{{__('Member Photo')}}" />
                            </td>

                            <!-- Name -->
                            <td>
                                <span v-if="member.id === user.id">
                                    {{__('You')}}
                                </span>

                                <span v-else>
                                    @{{ member.name }}
                                </span>
                            </td>

                            <!-- Role -->
                            <td v-if="roles.length > 0">
                                @{{ teamMemberRole(member) }}
                            </td>

                            <td class="td-fit">
                                <button class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-blue-dark border-blue bg-white hover:bg-blue-light hover:text-blue-darker" @click="editTeamMember(member)" v-if="roles.length > 1 && canEditTeamMember(member)">
                                    <i class="fa fa-cog"></i>
                                </button>

                                <button class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-red-dark border-red bg-white hover:bg-red-light hover:text-red-darker" @click="approveTeamMemberDelete(member)" v-if="canDeleteTeamMember(member)">
                                <i class="fa fa-remove"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Update Team Member Modal -->
        <div class="modal" id="modal-update-team-member" tabindex="-1" role="dialog">
            <div class="modal-dialog" v-if="updatingTeamMember">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            {{__('teams.edit_team_member')}} (@{{ updatingTeamMember.name }})
                        </h5>
                    </div>

                    <div class="modal-body">
                        <!-- Update Team Member Form -->
                        <form role="form">
                            <div class="mb-4 flex flex-wrap">
                                <label class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">
                                    {{__('Role')}}
                                </label>

                                <div class="md:w-1/2 pr-4 pl-4">
                                    <select class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" v-model="updateTeamMemberForm.role" :class="{'bg-red-dark': updateTeamMemberForm.errors.has('role')}">
                                        <option v-for="role in roles" :value="role.value">
                                            @{{ role.text }}
                                        </option>
                                    </select>

                                    <span class="hidden mt-1 text-sm text-red" v-if="updateTeamMemberForm.errors.has('role')">
                                        @{{ updateTeamMemberForm.errors.get('role') }}
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline btn-default" data-dismiss="modal">{{__('absolute pin-t pin-b pin-r px-4 py-3')}}</button>

                        <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-blue-lightest bg-blue hover:bg-blue-light" @click="update" :opacity-75="updateTeamMemberForm.busy">
                            {{__('Update')}}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Team Member Modal -->
        <div class="modal" id="modal-delete-member" tabindex="-1" role="dialog">
            <div class="modal-dialog" v-if="deletingTeamMember">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            {{__('teams.remove_team_member')}} (@{{ deletingTeamMember.name }})
                        </h5>
                    </div>

                    <div class="modal-body">
                        {{__('teams.are_you_sure_you_want_to_delete_member')}}
                    </div>

                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline btn-default" data-dismiss="modal">{{__('No, Go Back')}}</button>

                        <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-red-lightest bg-red hover:bg-red-light" @click="deleteMember" :opacity-75="deleteTeamMemberForm.busy">
                            {{__('Yes, Remove')}}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</spark-team-members>
