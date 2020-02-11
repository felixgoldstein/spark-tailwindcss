<spark-resume-subscription :user="user" :team="team"
                :plans="plans" :billable-type="billableType" inline-template>

    <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light card-default">
        <div class="py-3 px-6 mb-0 bg-grey-lighter border-b-1 border-grey-light text-grey-darkest">
            <div class="float-left">
                {{__('Resume Subscription')}}
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
            <div class="relative px-3 py-3 mb-4 border rounded text-red-darker border-red-dark bg-red-lighter mb-4" v-if="planForm.errors.has('plan')">
                @{{ planForm.errors.get('plan') }}
            </div>

            <!-- Cancellation Information -->
            <div class="m-4">
                <?php echo __('You have cancelled your subscription to the :planName plan.', ['planName' => '{{ activePlan.name }} ({{ activePlan.interval | capitalize }})']); ?>
            </div>

            <div class="m-4">
                <?php echo __('The benefits of your subscription will continue until your current billing period ends on :date. You may resume your subscription at no extra cost until the end of the billing period.', ['date' => '{{ activeSubscription.ends_at | date }}']); ?>
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
                    <tr v-for="plan in paidPlansForActiveInterval">
                        <!-- Plan Name -->
                        <td>
                            <div class="flex align-center">
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
                                <strong class="table-plan-price">@{{ priceWithTax(plan) | currency }}</strong>
                                @{{ plan.type == 'user' && spark.chargesUsersPerSeat ? '/ '+ spark.seatName : '' }}
                                @{{ plan.type == 'user' && spark.chargesUsersPerTeam ? '/ '+ __('teams.team') : '' }}
                                @{{ plan.type == 'team' && spark.chargesTeamsPerSeat ? '/ '+ spark.teamSeatName : '' }}
                                @{{ plan.type == 'team' && spark.chargesTeamsPerMember ? '/ '+ __('teams.member') : '' }}
                                / @{{ __(plan.interval) | capitalize }}
                            </div>
                        </td>

                        <!-- Plan Select Button -->
                        <td class="text-right">
                            <button class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline btn-plan"
                                    v-bind:class="{'btn-default': ! isActivePlan(plan), 'text-yellow-lightest bg-yellow hover:bg-yellow-light': isActivePlan(plan)}"
                                    @click="updateSubscription(plan)"
                                    :disabled="selectingPlan">

                                <span v-if="selectingPlan === plan">
                                    <i class="fa fa-btn fa-spinner fa-spin"></i> {{__('Resuming')}}
                                </span>

                                <span v-if="! isActivePlan(plan) && selectingPlan !== plan">
                                    {{__('Switch')}}
                                </span>

                                <span v-if="isActivePlan(plan) && selectingPlan !== plan">
                                    {{__('Resume Subscription')}}
                                </span>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</spark-resume-subscription>
