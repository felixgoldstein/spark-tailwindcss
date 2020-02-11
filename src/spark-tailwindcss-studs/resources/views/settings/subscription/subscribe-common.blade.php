<div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light card-default">
    <div class="py-3 px-6 mb-0 bg-grey-lighter border-b-1 border-grey-light text-grey-darkest">
        <div class="float-left">
            {{__('Subscribe')}}
        </div>

        <!-- Interval Selector Button Group -->
        <div class="float-right">
            <div class="relative inline-flex align-middle py-1 px-2 text-sm leading-tight" role="group" v-if="hasMonthlyAndYearlyPaidPlans">
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
        <!-- European VAT Notice -->
        @if (Spark::collectsEuropeanVat())
            <p class="m-4">
                {{__('All subscription plan prices are excluding applicable VAT.')}}
            </p>
        @endif

        <!-- Plan Error Message -->
        <div class="relative px-3 py-3 mb-4 border rounded text-red-darker border-red-dark bg-red-lighter m-4" v-if="form.errors.has('plan')">
            @{{ form.errors.get('plan') }}
        </div>

        <table class="w-full max-w-full mb-4 bg-transparent block w-full overflow-auto scrolling-touch table-valign-middle mb-0 ">
            <thead></thead>
            <tbody>
                <tr v-for="plan in paidPlansForActiveInterval">
                    <!-- Plan Name -->
                    <td>
                        <div class="flex align-center">
                            <i class="radio-select mr-2" @click="selectPlan(plan)"
                               :class="{'radio-select-selected': selectedPlan == plan, invisible: form.busy}"></i>
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
                        <span class="table-plan-text">
                            <strong class="table-plan-price">@{{ plan.price | currency }}</strong>
                            @{{ plan.type == 'user' && spark.chargesUsersPerSeat ? '/ '+ spark.seatName : '' }}
                            @{{ plan.type == 'user' && spark.chargesUsersPerTeam ? '/ '+ __('teams.team') : '' }}
                            @{{ plan.type == 'team' && spark.chargesTeamsPerSeat ? '/ '+ spark.teamSeatName : '' }}
                            @{{ plan.type == 'team' && spark.chargesTeamsPerMember ? '/ '+ __('teams.member') : '' }}
                            / @{{ __(plan.interval) | capitalize }}
                        </span>
                    </td>

                    <!-- Trial Days -->
                    <td class="table-plan-price table-plane-text text-right">
                        <span v-if="plan.trialDays && ! hasSubscribed(plan)">
                            @{{ plan.trialDays}} {{__('Day Trial')}}
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
