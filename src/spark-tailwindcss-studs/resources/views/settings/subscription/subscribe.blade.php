<spark-subscribe-stripe :user="user" :team="team"
                        :plans="plans" :billable-type="billableType" inline-template>

    <div>
        <!-- Common Subscribe Form Contents -->
    @include('spark::settings.subscription.subscribe-common')

    <!-- Billing Information -->
        <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light card-default" v-show="selectedPlan">
            <div class="py-3 px-6 mb-0 bg-grey-lighter border-b-1 border-grey-light text-grey-darkest">{{__('Billing Information')}}</div>

            <div class="flex-auto p-6">
                <!-- Generic 500 Level Error Message / Stripe Threw Exception -->
                <div class="relative px-3 py-3 mb-4 border rounded text-red-darker border-red-dark bg-red-lighter" v-if="form.errors.has('form')">
                    {{__('We had trouble validating your card. It\'s possible your card provider is preventing us from charging the card. Please contact your card provider or customer support.')}}
                </div>

                <form role="form">
                    <!-- Payment Method -->
                    <div class="mb-4 flex flex-wrap" v-if="hasPaymentMethod()">
                        <label for="use_existing_payment_method" class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{__('Payment Method')}}</label>

                        <div class="md:w-1/2 pr-4 pl-4">
                            <select name="use_existing_payment_method" v-model="form.use_existing_payment_method" id="use_existing_payment_method" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded">
                                <option value="1">{{__('Use existing payment method')}}</option>
                                <option value="0">{{__('Use a different method')}}</option>
                            </select>
                        </div>
                    </div>

                    <!-- Cardholder's Name -->
                    <div class="mb-4 flex flex-wrap" v-show="form.use_existing_payment_method != '1'">
                        <label for="name" class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{__('Cardholder\'s Name')}}</label>

                        <div class="md:w-1/2 pr-4 pl-4">
                            <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" name="name" v-model="cardForm.name">
                        </div>
                    </div>

                    <!-- Card Details -->
                    <div class="mb-4 flex flex-wrap" v-show="form.use_existing_payment_method != '1'">
                        <label for="subscription-card-element" class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{__('relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light')}}</label>

                        <div class="md:w-1/2 pr-4 pl-4">
                            <div id="subscription-card-element"></div>
                            <input type="hidden" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" :class="{'bg-red-dark': cardForm.errors.has('relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light')}">
                            <span class="hidden mt-1 text-sm text-red" v-show="cardForm.errors.has('relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light')">
                                @{{ cardForm.errors.get('card') }}
                            </span>
                        </div>
                    </div>

                    <!-- Billing Address Fields -->
                @if (Spark::collectsBillingAddress())
                    @include('spark::settings.subscription.subscribe-address')
                @endif

                <!-- ZIP Code -->
                    <div class="mb-4 flex flex-wrap" v-if=" ! spark.collectsBillingAddress">
                        <label for="number" class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{__('ZIP / Postal Code')}}</label>

                        <div class="md:w-1/2 pr-4 pl-4">
                            <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" name="zip" v-model="form.zip">
                        </div>
                    </div>

                    <!-- Coupon -->
                    <div class="mb-4 flex flex-wrap">
                        <label class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{__('Coupon')}}</label>

                        <div class="md:w-1/2 pr-4 pl-4">
                            <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" v-model="form.coupon" :class="{'bg-red-dark': form.errors.has('coupon')}">

                            <span class="hidden mt-1 text-sm text-red" v-show="form.errors.has('coupon')">
                            @{{ form.errors.get('coupon') }}
                        </span>
                        </div>
                    </div>

                    <!-- Tax / Price Information -->
                    <div class="mb-4 flex flex-wrap" v-if="spark.collectsEuropeanVat && countryCollectsVat && selectedPlan">
                        <label class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">&nbsp;</label>

                        <div class="md:w-1/2 pr-4 pl-4">
                            <div class="relative px-3 py-3 mb-4 border rounded text-teal-darker border-teal-dark bg-teal-lighter" style="margin: 0;">
                                <strong>{{__('Tax')}}:</strong> @{{ taxAmount(selectedPlan) | currency }}
                                <br><br>
                                <strong>{{__('Total Price Including Tax')}}:</strong>
                                @{{ priceWithTax(selectedPlan) | currency }}
                                @{{ selectedPlan.type == 'user' && spark.chargesUsersPerSeat ? '/ '+ spark.seatName : '' }}
                                @{{ selectedPlan.type == 'user' && spark.chargesUsersPerTeam ? '/ '+ __('teams.team') : '' }}
                                @{{ selectedPlan.type == 'team' && spark.chargesTeamsPerSeat ? '/ '+ spark.teamSeatName : '' }}
                                @{{ selectedPlan.type == 'team' && spark.chargesTeamsPerMember ? '/ '+ __('teams.member') : '' }}
                                / @{{ __(selectedPlan.interval) | capitalize }}
                            </div>
                        </div>
                    </div>

                    <!-- Subscribe Button -->
                    <div class="mb-4 flex flex-wrap mb-0">
                        <div class="md:w-1/2 pr-4 pl-4 md:mx-1/3">
                            <button type="submit" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-blue-lightest bg-blue hover:bg-blue-light" @click.prevent="subscribe" :opacity-75="form.busy">
                            <span v-if="form.busy">
                                <i class="fa fa-btn fa-spinner fa-spin"></i> {{__('Subscribing')}}
                            </span>

                                <span v-else>
                                {{__('Subscribe')}}
                            </span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</spark-subscribe-stripe>
