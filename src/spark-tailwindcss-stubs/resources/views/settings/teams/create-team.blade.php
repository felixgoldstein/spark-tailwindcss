<spark-create-team inline-template>
    <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light card-default">
        <div class="py-3 px-6 mb-0 bg-grey-lighter border-b-1 border-grey-light text-grey-darkest">{{__('teams.create_team')}}</div>

        <div class="flex-auto p-6">
            <form role="form" v-if="canCreateMoreTeams">
                <!-- Name -->
                <div class="mb-4 flex flex-wrap">
                    <label class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{__('teams.team_name')}}</label>

                    <div class="md:w-1/2 pr-4 pl-4">
                        <input type="text" id="create-team-name" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" name="name" v-model="form.name" :class="{'bg-red-dark': form.errors.has('name')}">

                        <span class="hidden mt-1 text-sm text-red" v-if="hasTeamLimit">
                            <?php echo __('teams.you_have_x_teams_remaining', ['teamCount' => '{{ remainingTeams }}']); ?>
                        </span>

                        <span class="hidden mt-1 text-sm text-red" v-show="form.errors.has('name')">
                            @{{ form.errors.get('name') }}
                        </span>
                    </div>
                </div>

                @if (Spark::teamsIdentifiedByPath())
                <!-- Slug (Only Shown When Using Paths For Teams) -->
                <div class="mb-4 flex flex-wrap">
                    <label class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{__('teams.team_slug')}}</label>

                    <div class="md:w-1/2 pr-4 pl-4">
                        <input type="text" id="create-team-slug" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" name="slug" v-model="form.slug" :class="{'bg-red-dark': form.errors.has('slug')}">

                        <small class="block mt-1 text-grey" v-show=" ! form.errors.has('slug')">
                            {{__('teams.slug_input_explanation')}}
                        </small>

                        <span class="hidden mt-1 text-sm text-red" v-show="form.errors.has('slug')">
                            @{{ form.errors.get('slug') }}
                        </span>
                    </div>
                </div>
                @endif

                <!-- Create Button -->
                <div class="mb-4 flex flex-wrap mb-0">
                    <div class="md:mx-1/3 md:w-1/2 pr-4 pl-4">
                        <button type="submit" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-blue-lightest bg-blue hover:bg-blue-light"
                                @click.prevent="create"
                                :disabled="form.busy">

                            {{__('Create')}}
                        </button>
                    </div>
                </div>
            </form>

            <div v-else>
                <span class="text-red">
                    {{__('teams.plan_allows_no_more_teams')}},
                    <a href="{{ url('/settings#/subscription') }}">{{__('please upgrade your subscription')}}</a>.
                </span>
            </div>
        </div>
    </div>
</spark-create-team>
