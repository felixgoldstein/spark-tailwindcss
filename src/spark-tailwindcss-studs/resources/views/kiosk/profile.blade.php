<spark-kiosk-profile :user="user" :plans="plans" inline-template>
    <div>
        <!-- Loading Indicator -->
        <div class="flex flex-wrap" v-if="loading">
            <div class="md:w-full pr-4 pl-4">
                <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light card-default">
                    <div class="flex-auto p-6">
                        <i class="fa fa-btn fa-spinner fa-spin"></i> {{__('Loading')}}
                    </div>
                </div>
            </div>
        </div>

        <!-- User Profile -->
        <div v-if=" ! loading && profile">
            <div class="flex flex-wrap">
                <div class="md:w-full pr-4 pl-4">
                    <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light card-default">
                        <div class="py-3 px-6 mb-0 bg-grey-lighter border-b-1 border-grey-light text-grey-darkest">
                            <div>
                                <i class="fa fa-btn fa-times" style="cursor: pointer;" @click="showSearch"></i>
                                @{{ profile.name }}
                            </div>
                        </div>

                        <div class="flex-auto p-6">
                            <div class="flex flex-wrap">
                                <!-- Profile Photo -->
                                <div class="md:w-1/4 pr-4 pl-4 text-center">
                                    <img :src="profile.photo_url" class="spark-profile-photo-xl" alt="{{__('Profile Photo')}}" />
                                </div>

                                <div class="md:w-3/4 pr-4 pl-4">
                                    <!-- Email Address -->
                                    <p>
                                        <strong>{{__('Email Address')}}:</strong> <a :href="'mailto:'+profile.email">@{{ profile.email }}</a>
                                    </p>

                                    <!-- Joined Date -->
                                    <p>
                                        <strong>{{__('Joined')}}:</strong> @{{ profile.created_at | datetime }}
                                    </p>

                                    <!-- Subscription -->
                                    <p>
                                        <strong>{{__('Subscription')}}:</strong>

                                        <span v-if="activePlan(profile)">
                                            <a :href="customerUrlOnBillingProvider(profile)" target="_blank">
                                                @{{ activePlan(profile).name }} (@{{ __(activePlan(profile).interval) | capitalize }})
                                            </a>
                                        </span>

                                        <span v-else>
                                            {{__('None')}}
                                        </span>
                                    </p>

                                    <!-- Total Revenue -->
                                    <p>
                                        <strong>{{__('Total Revenue')}}:</strong> @{{ revenue | currency }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="py-3 px-6 bg-grey-lighter border-t-1 border-grey-light card-flush text-right">
                            <button class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-blue-lightest bg-blue hover:bg-blue-light py-1 px-2 text-sm leading-tight" v-if="spark.usesStripe && profile.stripe_id" @click="addDiscount(profile)">
                                {{__('Apply Discount')}}
                            </button>

                            <button class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline btn-default py-1 px-2 text-sm leading-tight" @click="impersonate(profile)" :opacity-75="user.id === profile.id">
                                {{__('Impersonate')}}
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Teams -->
            <div class="flex flex-wrap" v-if="spark.usesTeams && profile.owned_teams.length > 0">
                <div class="md:w-full pr-4 pl-4">
                    <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light card-default">
                        <div class="py-3 px-6 mb-0 bg-grey-lighter border-b-1 border-grey-light text-grey-darkest">
                            {{__('teams.teams')}}
                        </div>

                        <div class="block w-full overflow-auto scrolling-touch">
                            <table class="w-full max-w-full mb-4 bg-transparent table-valign-middle mb-0">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>{{__('Name')}}</th>
                                        <th>{{__('Subscription')}}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr v-for="team in profile.owned_teams">
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

                                        <!-- Subscription -->
                                        <td>
                                            <div>
                                                <span v-if="activePlan(team)">
                                                    <a :href="customerUrlOnBillingProvider(team)" target="_blank">
                                                        @{{ activePlan(team).name }} (@{{ __(activePlan(team).interval) | capitalize }})
                                                    </a>
                                                </span>

                                                <span v-else>
                                                    {{__('None')}}
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Apply Discount Modal -->
        <div>
            @include('spark::kiosk.modals.add-discount')
        </div>
    </div>
</spark-kiosk-profile>
