<spark-redeem-coupon :user="user" :team="team" :billable-type="billableType" inline-template>
    <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light card-default">
        <div class="py-3 px-6 mb-0 bg-grey-lighter border-b-1 border-grey-light text-grey-darkest">{{__('Redeem Coupon')}}</div>

        <div class="flex-auto p-6">
            <div class="relative px-3 py-3 mb-4 border rounded text-green-darker border-green-dark bg-green-lighter" v-if="form.successful">
                {{__('Coupon accepted! The discount will be applied to your next invoice.')}}
            </div>

            <form role="form">
                <!-- Coupon Code -->
                <div class="mb-4 flex flex-wrap">
                    <label class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{__('Coupon Code')}}</label>

                    <div class="md:w-1/2 pr-4 pl-4">
                        <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" name="coupon" v-model="form.coupon" :class="{'bg-red-dark': form.errors.has('coupon')}">

                        <span class="hidden mt-1 text-sm text-red" v-show="form.errors.has('coupon')">
                            @{{ form.errors.get('coupon') }}
                        </span>
                    </div>
                </div>

                <!-- Redeem Button -->
                <div class="mb-4 flex flex-wrap mb-0">
                    <div class="md:mx-1/3 md:w-1/2 pr-4 pl-4">
                        <button type="submit" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-blue-lightest bg-blue hover:bg-blue-light"
                                @click.prevent="redeem"
                                :disabled="form.busy">

                            <span v-if="form.busy">
                                <i class="fa fa-btn fa-spinner fa-spin"></i> {{__('Redeeming')}}
                            </span>

                            <span v-else>
                                {{__('Redeem')}}
                            </span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</spark-redeem-coupon>
