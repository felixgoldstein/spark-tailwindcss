<spark-send-invitation :user="user" :team="team" :billable-type="billableType" default-role="{{Spark::defaultRole()}}" inline-template>
    <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light card-default">
        <div class="py-3 px-6 mb-0 bg-grey-lighter border-b-1 border-grey-light text-grey-darkest">{{__('Send Invitation')}}</div>

        <div class="flex-auto p-6">
            <!-- Success Message -->
            <div class="relative px-3 py-3 mb-4 border rounded text-green-darker border-green-dark bg-green-lighter" v-if="form.successful">
                {{__('The invitation has been sent!')}}
            </div>

            <form role="form" v-if="canInviteMoreTeamMembers">
                <!-- E-Mail Address -->
                <div class="mb-4 flex flex-wrap">
                    <label class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{__('E-Mail Address')}}</label>

                    <div class="md:w-1/2 pr-4 pl-4">
                        <input type="email" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" name="email" v-model="form.email" :class="{'bg-red-dark': form.errors.has('email')}">
                        <span class="hidden mt-1 text-sm text-red" v-if="hasTeamMembersLimit">
                            <?php echo __('teams.you_have_x_invitations_remaining', ['count' => '{{ remainingTeamMembers }}']); ?>
                        </span>
                        <span class="hidden mt-1 text-sm text-red" v-show="form.errors.has('email')">
                            @{{ form.errors.get('email') }}
                        </span>
                    </div>
                </div>

                <!-- Role -->
                <div class="mb-4 flex flex-wrap" v-if="roles.length > 0">
                    <label class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{__('Role')}}</label>

                    <div class="md:w-1/2 pr-4 pl-4">
                        <select class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" v-model="form.role" :class="{'bg-red-dark': form.errors.has('role')}" >
                            <option v-for="role in roles" :value="role.value">@{{ role.text }}</option>
                        </select>
                        <span class="hidden mt-1 text-sm text-red" v-show="form.errors.has('role')">
                            @{{ form.errors.get('role') }}
                        </span>
                    </div>
                </div>

                <!-- Send Invitation Button -->
                <div class="mb-4 flex flex-wrap mb-0">
                    <div class="md:mx-1/3 md:w-1/2 pr-4 pl-4">
                        <button type="submit" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-blue-lightest bg-blue hover:bg-blue-light"
                                @click.prevent="send"
                                :disabled="form.busy">

                            <span v-if="form.busy">
                                <i class="fa fa-btn fa-spinner fa-spin"></i> {{__('Sending')}}
                            </span>

                            <span v-else>
                                {{__('Send Invitation')}}
                            </span>
                        </button>
                    </div>
                </div>
            </form>

            <div v-else>
                <span class="text-red">
                    {{__('Your current plan doesn\'t allow you to invite more members, please upgrade your subscription.')}}
                </span>
            </div>
        </div>
    </div>
</spark-send-invitation>
