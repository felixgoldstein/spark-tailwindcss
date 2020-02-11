<spark-enable-two-factor-auth :user="user" inline-template>
    <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light card-default">
        <div class="py-3 px-6 mb-0 bg-grey-lighter border-b-1 border-grey-light text-grey-darkest">{{__('Two-Factor Authentication')}}</div>

        <div class="flex-auto p-6">
            <!-- Information Message -->
            <div class="relative px-3 py-3 mb-4 border rounded text-teal-darker border-teal-dark bg-teal-lighter">
                {!! __('In order to use two-factor authentication, you must install the :authyLink application on your smartphone. Authy is available for iOS and Android.', ['authyLink' => '<strong><a href="https://authy.com" target="_blank">Authy</a></strong>']) !!}
            </div>

            <form role="form">
                <!-- Country Code -->
                <div class="mb-4 flex flex-wrap">
                    <label class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{__('Country Code')}}</label>

                    <div class="md:w-1/2 pr-4 pl-4">
                        <input type="number" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" name="country_code" v-model="form.country_code" :class="{'bg-red-dark': form.errors.has('country_code')}">

                        <span class="hidden mt-1 text-sm text-red" v-show="form.errors.has('country_code')">
                            @{{ form.errors.get('country_code') }}
                        </span>
                    </div>
                </div>

                <!-- Phone Number -->
                <div class="mb-4 flex flex-wrap">
                    <label class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{__('Phone Number')}}</label>

                    <div class="md:w-1/2 pr-4 pl-4">
                        <input type="tel" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" name="phone" v-model="form.phone" :class="{'bg-red-dark': form.errors.has('phone')}">

                        <span class="hidden mt-1 text-sm text-red" v-show="form.errors.has('phone')">
                            @{{ form.errors.get('phone') }}
                        </span>
                    </div>
                </div>

                <!-- Enable Button -->
                <div class="mb-4 flex flex-wrap mb-0">
                    <div class="md:w-1/2 pr-4 pl-4 md:mx-1/3">
                        <button type="submit" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-blue-lightest bg-blue hover:bg-blue-light"
                                @click.prevent="enable"
                                :disabled="form.busy">

                            <span v-if="form.busy">
                                <i class="fa fa-btn fa-spinner fa-spin"></i> {{__('Enabling')}}
                            </span>

                            <span v-else>
                                {{__('Enable')}}
                            </span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</spark-enable-two-factor-auth>
