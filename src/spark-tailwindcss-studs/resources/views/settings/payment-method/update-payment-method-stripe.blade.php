<spark-update-payment-method-stripe :user="user" :team="team" :billable-type="billableType" inline-template>
    <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light card-default">
        <!-- Update Payment Method Heading -->
        <div class="py-3 px-6 mb-0 bg-grey-lighter border-b-1 border-grey-light text-grey-darkest">
            <div class="float-left">
                {{__('Update Payment Method')}}
            </div>

            <div class="float-right">
                <span v-if="billable.card_last_four">
                    <i :class="['fa', 'fa-btn', cardIcon]"></i>
                    ************@{{ billable.card_last_four }}
                </span>
            </div>

            <div class="clearfix"></div>
        </div>

        <div class="flex-auto p-6">
            <!-- Card Update Success Message -->
            <div class="relative px-3 py-3 mb-4 border rounded text-green-darker border-green-dark bg-green-lighter" v-if="form.successful">
                {{__('Your card has been updated.')}}
            </div>

            <!-- Generic 500 Level Error Message / Stripe Threw Exception -->
            <div class="relative px-3 py-3 mb-4 border rounded text-red-darker border-red-dark bg-red-lighter" v-if="form.errors.has('form')">
                {{__('We had trouble updating your card. It\'s possible your card provider is preventing us from charging the card. Please contact your card provider or customer support.')}}
            </div>

            <form role="form">
                <!-- Cardholder's Name -->
                <div class="mb-4 flex flex-wrap">
                    <label for="name" class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{__('Cardholder\'s Name')}}</label>

                    <div class="md:w-1/2 pr-4 pl-4">
                        <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" v-model="cardForm.name">
                    </div>
                </div>

                <!-- Card Details -->
                <div class="mb-4 flex flex-wrap">
                    <label for="payment-card-element" class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{__('relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light')}}</label>

                    <div class="md:w-1/2 pr-4 pl-4">
                        <div id="payment-card-element"></div>
                        <input type="hidden" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" :class="{'bg-red-dark': cardForm.errors.has('relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light')}">
                        <span class="hidden mt-1 text-sm text-red" v-show="cardForm.errors.has('relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light')">
                            @{{ cardForm.errors.get('card') }}
                        </span>
                    </div>
                </div>

                <!-- Billing Address Fields -->
                @if (Spark::collectsBillingAddress())
                    @include('spark::settings.payment-method.update-payment-method-address')
                @endif

                <!-- Zip Code -->
                <div class="mb-4 flex flex-wrap" v-if=" ! spark.collectsBillingAddress">
                    <label for="zip" class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{__('ZIP / Postal Code')}}</label>

                    <div class="md:w-1/2 pr-4 pl-4">
                        <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" v-model="form.zip">
                    </div>
                </div>

                <!-- Update Button -->
                <div class="mb-4 flex flex-wrap mb-0">
                    <div class="md:w-1/2 pr-4 pl-4 md:mx-1/3">
                        <button type="submit" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-blue-lightest bg-blue hover:bg-blue-light" @click.prevent="update" :opacity-75="form.busy">
                            <span v-if="form.busy">
                                <i class="fa fa-btn fa-spinner fa-spin"></i> {{__('Updating')}}
                            </span>

                            <span v-else>
                                {{__('Update')}}
                            </span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</spark-update-payment-method-stripe>
