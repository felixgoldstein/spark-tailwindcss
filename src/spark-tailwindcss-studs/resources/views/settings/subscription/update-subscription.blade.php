<spark-update-subscription :user="user" :team="team"
                :plans="plans" :billable-type="billableType" inline-template>
    <div>
        <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light card-default">
            <div class="py-3 px-6 mb-0 bg-grey-lighter border-b-1 border-grey-light text-grey-darkest">
                <div class="float-left">
                    {{__('Update Subscription')}}
                </div>

                <!-- Interval Selector Button Group -->
                <div class="float-right">
                    <div class="relative inline-flex align-middle py-1 px-2 text-sm leading-tight" v-if="hasMonthlyAndYearlyPlans">
                        <!-- Monthly Plans -->
                        <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-grey-lightest-lightest bg-grey-lightest hover:bg-grey-lightest-light"
                                @click="showMonthlyPlans"
                                :class="{'active': showingMonthlyPlans}">

                            {{__('Monthly')}}
                        </button>

                        <!-- Yearly Plans -->
                        <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-grey-lightest-lightest bg-grey-lightest hover:bg-grey-lightest-light"
                                @click="showYearlyPlans"
                                :class="{'active': showingYearlyPlans}">

                            {{__('Yearly')}}
                        </button>
                    </div>
                </div>

                <div class="clearfix"></div>
            </div>

            <div class="block w-full overflow-auto scrolling-touch">
                <!-- Plan Error Message - In General Will Never Be Shown -->
                <div class="relative px-3 py-3 mb-4 border rounded text-red-darker border-red-dark bg-red-lighter m-4" v-if="planForm.errors.has('plan')">
                    @{{ planForm.errors.get('plan') }}
                </div>

                <!-- Current Subscription (Active) -->
                <div class="m-4" v-if="activePlan.active">
                    <?php echo __('You are currently subscribed to the :planName plan.', ['planName' => '{{ activePlan.name }} ({{ __(activePlan.interval) | capitalize }})']); ?>
                </div>

                <!-- Current Subscription (Archived) -->
                <div class="relative px-3 py-3 mb-4 border rounded text-yellow-darker border-yellow-dark bg-yellow-lighter m-4" v-if=" ! activePlan.active">
                    <?php echo __('You are currently subscribed to the :planName plan.', ['planName' => '{{ activePlan.name }} ({{ __(activePlan.interval) | capitalize }})']); ?>
                    {{__('This plan has been discontinued, but you may continue your subscription to this plan as long as you wish. If you cancel your subscription and later want to begin a new subscription, you will need to choose from one of the active plans listed below.')}}
                </div>

                <!-- European VAT Notice -->
                @if (Spark::collectsEuropeanVat())
                    <p class="m-4">
                        {{__('All subscription plan prices include applicable VAT.')}}
                    </p>
                @endif

                <table class="w-full max-w-full mb-4 bg-transparent block w-full overflow-auto scrolling-touch table-valign-middle mb-0 ">
                    <thead></thead>
                    <tbody>
                        <tr v-for="plan in plansForActiveInterval">
                            <!-- Plan Name -->
                            <td>
                                <div class="flex align-center">
                                    <i class="radio-select mr-2" @click="!isActivePlan(plan) ? confirmPlanUpdate(plan) : 0"
                                    :class="{'radio-select-selected': isActivePlan(plan), invisible: selectingPlan}"></i>
                                    @{{ plan.name }}
                                </div>
                            </td>

                            <!-- Plan Features Button -->
                            <td>
                                <button class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline btn-default" @click="showPlanDetails(plan)">
                                    <i class="fa fa-btn fa-star-o"></i> {{__('Features')}}
                                </button>
                            </td>

                            <!-- Plan Price -->
                            <td>
                                <div>
                                    <span v-if="plan.price == 0">
                                        {{__('Free')}}
                                    </span>

                                    <span v-else>
                                        <strong class="table-plan-price">@{{ priceWithTax(plan) | currency }}</strong>
                                        @{{ plan.type == 'user' && spark.chargesUsersPerSeat ? '/ '+ spark.seatName : '' }}
                                        @{{ plan.type == 'user' && spark.chargesUsersPerTeam ? '/ '+ __('teams.team') : '' }}
                                        @{{ plan.type == 'team' && spark.chargesTeamsPerSeat ? '/ '+ spark.teamSeatName : '' }}
                                        @{{ plan.type == 'team' && spark.chargesTeamsPerMember ? '/ '+ __('teams.member') : '' }}
                                        / @{{ __(plan.interval) | capitalize }}
                                    </span>
                                </div>
                            </td>

                            <!-- Plan Select Button -->
                            <td class="text-right">
                                <span v-if="selectingPlan && selectingPlan === plan">
                                    <i class="fa fa-btn fa-spinner fa-spin"></i> {{__('Updating')}}
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Confirm Plan Update Modal -->
        <div class="modal" id="modal-confirm-plan-update" tabindex="-2" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content" v-if="confirmingPlan">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title">
                            {{__('Update Subscription')}}
                        </h5>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <p>
                            <?php echo __('Are you sure you want to switch to the :planName plan?', ['planName' => '<strong>{{ confirmingPlan.name }} ({{ confirmingPlan.interval | capitalize }})</strong>']) ?>
                        </p>
                    </div>

                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline btn-default" data-dismiss="modal">{{__('No, Go Back')}}</button>

                        <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-blue-lightest bg-blue hover:bg-blue-light" @click="approvePlanUpdate">{{__('Yes, I\'m Sure')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</spark-update-subscription>
