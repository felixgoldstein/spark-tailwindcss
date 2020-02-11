@extends('spark::layouts.app')

@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
@endpush

@section('content')
    <spark-register-stripe inline-template>
        <div>
            <div class="spark-screen container mx-auto">
                <!-- Common Register Form Contents -->
            @include('spark::auth.register-common')

            <!-- Billing Information -->
                <div class="flex flex-wrap justify-center" v-if="selectedPlan && selectedPlan.price > 0">
                    <div class="lg:w-2/3 pr-4 pl-4">
                        <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light card-default">
                            <div class="py-3 px-6 mb-0 bg-grey-lighter border-b-1 border-grey-light text-grey-darkest">{{__('Billing Information')}}</div>

                            <div class="flex-auto p-6">
                                <!-- Generic 500 Level Error Message / Stripe Threw Exception -->
                                <div class="relative px-3 py-3 mb-4 border rounded text-red-darker border-red-dark bg-red-lighter" v-if="registerForm.errors.has('form')">
                                    {{__('We had trouble validating your card. It\'s possible your card provider is preventing us from charging the card. Please contact your card provider or customer support.')}}
                                </div>

                                <form role="form">
                                    <!-- Cardholder's Name -->
                                    <div class="mb-4 flex flex-wrap">
                                        <label for="name" class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{__('Cardholder\'s Name')}}</label>

                                        <div class="md:w-1/2 pr-4 pl-4">
                                            <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" name="name" v-model="cardForm.name">
                                        </div>
                                    </div>

                                    <!-- Card Details -->
                                    <div class="mb-4 flex flex-wrap">
                                        <label for="name" class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{__('relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light')}}</label>

                                        <div class="md:w-1/2 pr-4 pl-4">
                                            <div id="card-element"></div>
                                            <input type="hidden" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" :class="{'bg-red-dark': cardForm.errors.has('relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light')}">
                                            <span class="hidden mt-1 text-sm text-red" v-show="cardForm.errors.has('relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light')">
                                            @{{ cardForm.errors.get('card') }}
                                        </span>
                                        </div>
                                    </div>

                                    <!-- Billing Address Fields -->
                                @if (Spark::collectsBillingAddress())
                                    @include('spark::auth.register-address')
                                @endif

                                <!-- ZIP Code -->
                                    <div class="mb-4 flex flex-wrap" v-if=" ! spark.collectsBillingAddress">
                                        <label class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{__('ZIP / Postal Code')}}</label>

                                        <div class="md:w-1/2 pr-4 pl-4">
                                            <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" name="zip" v-model="registerForm.zip" :class="{'bg-red-dark': registerForm.errors.has('zip')}">

                                            <span class="hidden mt-1 text-sm text-red" v-show="registerForm.errors.has('zip')">
                                            @{{ registerForm.errors.get('zip') }}
                                        </span>
                                        </div>
                                    </div>

                                    <!-- Coupon Code -->
                                    <div class="mb-4 flex flex-wrap" v-if="query.coupon">
                                        <label class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{__('Coupon Code')}}</label>

                                        <div class="md:w-1/2 pr-4 pl-4">
                                            <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" name="coupon" v-model="registerForm.coupon" :class="{'bg-red-dark': registerForm.errors.has('coupon')}">

                                            <span class="hidden mt-1 text-sm text-red" v-show="registerForm.errors.has('coupon')">
                                            @{{ registerForm.errors.get('coupon') }}
                                        </span>
                                        </div>
                                    </div>

                                    <!-- Terms And Conditions -->
                                    <div class="mb-4 flex flex-wrap">
                                        <div class="md:w-1/2 pr-4 pl-4 md:mx-1/3">
                                            <div class="relative block mb-2">
                                                <label class="text-grey-dark pl-6 mb-0">
                                                    <input type="checkbox" class="absolute mt-1 -ml-6" v-model="registerForm.terms">
                                                    {!! __('I Accept :linkOpen The Terms Of Service :linkClose', ['linkOpen' => '<a href="/terms" target="_blank">', 'linkClose' => '</a>']) !!}
                                                </label>
                                                <span class="hidden mt-1 text-sm text-red" v-show="registerForm.errors.has('terms')">
                                                <strong>@{{ registerForm.errors.get('terms') }}</strong>
                                            </span>
                                            </div>
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

                                    <!-- Register Button -->
                                    <div class="mb-4 flex flex-wrap mb-0">
                                        <div class="md:w-1/2 pr-4 pl-4 md:mx-1/3">
                                            <button type="submit" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-blue-lightest bg-blue hover:bg-blue-light" @click.prevent="register" :opacity-75="registerForm.busy">
                                            <span v-if="registerForm.busy">
                                                <i class="fa fa-btn fa-spinner fa-spin"></i> {{__('Registering')}}
                                            </span>

                                                <span v-else>
                                                <i class="fa fa-btn fa-check-circle"></i> {{__('Register')}}
                                            </span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Plan Features Modal -->
            @include('spark::modals.plan-details')
        </div>
    </spark-register-stripe>
@endsection
