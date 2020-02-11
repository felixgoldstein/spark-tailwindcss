<spark-update-extra-billing-information :user="user" :team="team" :billable-type="billableType" inline-template>
    <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light card-default">
        <div class="py-3 px-6 mb-0 bg-grey-lighter border-b-1 border-grey-light text-grey-darkest">{{__('Extra Billing Information')}}</div>

        <div class="flex-auto p-6">
            <!-- Information Message -->
            <div class="relative px-3 py-3 mb-4 border rounded text-teal-darker border-teal-dark bg-teal-lighter">
                {{__('This information will appear on all of your receipts, and is a great place to add your full business name, VAT number, or address of record. Do not include any confidential or financial information such as credit card numbers.')}}
            </div>

            <!-- Success Message -->
            <div class="relative px-3 py-3 mb-4 border rounded text-green-darker border-green-dark bg-green-lighter" v-if="form.successful">
                {{__('Your billing information has been updated!')}}
            </div>

            <!-- Extra Billing Information -->
            <form role="form">
                <div class="mb-4 flex flex-wrap">
                    <div class="md:w-full pr-4 pl-4">
                        <textarea class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" rows="7" v-model="form.information" style="font-family: monospace;" :class="{'bg-red-dark': form.errors.has('information')}"></textarea>

                        <span class="hidden mt-1 text-sm text-red" v-show="form.errors.has('information')">
                            @{{ form.errors.get('information') }}
                        </span>
                    </div>
                </div>

                <!-- Update Button -->
                <div class="mb-4 flex flex-wrap mb-0">
                    <div class="md:mx-1/3 md:w-2/3 pr-4 pl-4 text-right">
                        <button type="submit" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-blue-lightest bg-blue hover:bg-blue-light" @click.prevent="update" :opacity-75="form.busy">
                            {{__('Update')}}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</spark-update-extra-billing-information>
