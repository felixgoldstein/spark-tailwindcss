<div class="flex flex-wrap justify-center">
    <div class="lg:w-2/3 pr-4 pl-4">
        <!-- Coupon -->
        <div class="relative px-3 py-3 mb-4 border rounded text-green-darker border-green-dark bg-green-lighter" v-if="coupon">
            <?php echo __('The coupon :value discount will be applied to your subscription!', ['value' => '{{ discount }}']); ?>
        </div>

        <!-- Invalid Coupon -->
        <div class="relative px-3 py-3 mb-4 border rounded text-red-darker border-red-dark bg-red-lighter" v-if="invalidCoupon">
            {{__('Whoops! This coupon code is invalid.')}}
        </div>

        <!-- Invitation -->
        <div class="relative px-3 py-3 mb-4 border rounded text-green-darker border-green-dark bg-green-lighter" v-if="invitation">
            <?php echo __('teams.we_found_invitation_to_team', ['teamName' => '{{ invitation.team.name }}']); ?>
        </div>

        <!-- Invalid Invitation -->
        <div class="relative px-3 py-3 mb-4 border rounded text-red-darker border-red-dark bg-red-lighter" v-if="invalidInvitation">
            {{__('Whoops! This invitation code is invalid.')}}
        </div>
    </div>
</div>

<!-- Plan Selection -->
<div class="flex flex-wrap justify-center" v-if="paidPlans.length > 0 && !registerForm.invitation">
    <div class="lg:w-2/3 pr-4 pl-4">
        <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light card-default">
            <div class="py-3 px-6 mb-0 bg-grey-lighter border-b-1 border-grey-light text-grey-darkest">
                <div class="float-left">
                    {{__('Subscription')}}
                </div>

                <!-- Interval Selector Button Group -->
                <div class="float-right">
                    <div class="relative inline-flex align-middle py-1 px-2 text-sm leading-tight" v-if="hasMonthlyAndYearlyPlans" style="padding-top: 2px;">
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
                <div class="relative px-3 py-3 mb-4 border rounded text-red-darker border-red-dark bg-red-lighter m-4" v-if="registerForm.errors.has('plan')">
                    @{{ registerForm.errors.get('plan') }}
                </div>

                <!-- European VAT Notice -->
                @if (Spark::collectsEuropeanVat())
                    <p class="m-4">
                        {{__('All subscription plan prices are excluding applicable VAT.')}}
                    </p>
                @endif

                <table class="w-full max-w-full mb-4 bg-transparent block w-full overflow-auto scrolling-touch table-valign-middle mb-0 ">
                    <thead></thead>
                    <tbody>
                        <tr v-for="plan in plansForActiveInterval">
                            <!-- Plan Name -->
                            <td>
                                <div class="flex align-center">
                                    <i class="radio-select mr-2" @click="selectPlan(plan)"
                                    :class="{'radio-select-selected': isSelected(plan)}"></i>
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
                                <span v-if="plan.price == 0" class="table-plan-text">
                                    {{__('Free')}}
                                </span>

                                <span v-else class="table-plan-text">
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
                                <span v-if="plan.trialDays">
                                    <?php echo __(':trialDays Day Trial', ['trialDays' => '{{ plan.trialDays }}']); ?>
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Basic Profile -->
<div class="flex flex-wrap justify-center">
    <div class="lg:w-2/3 pr-4 pl-4">
        <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light card-default">
            <div class="py-3 px-6 mb-0 bg-grey-lighter border-b-1 border-grey-light text-grey-darkest">
                <span v-if="paidPlans.length > 0">
                    {{__('Profile')}}
                </span>

                <span v-else>
                    {{__('Register')}}
                </span>
            </div>

            <div class="flex-auto p-6">
                <!-- Generic Error Message -->
                <div class="relative px-3 py-3 mb-4 border rounded text-red-darker border-red-dark bg-red-lighter" v-if="registerForm.errors.has('form')">
                    @{{ registerForm.errors.get('form') }}
                </div>

                <!-- Invitation Code Error -->
                <div class="relative px-3 py-3 mb-4 border rounded text-red-darker border-red-dark bg-red-lighter" v-if="registerForm.errors.has('invitation')">
                    @{{ registerForm.errors.get('invitation') }}
                </div>

                <!-- Registration Form -->
                @include('spark::auth.register-common-form')
            </div>
        </div>
    </div>
</div>
