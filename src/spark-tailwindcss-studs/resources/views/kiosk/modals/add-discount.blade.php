<spark-kiosk-add-discount inline-template>
    <div>
        <div class="modal" id="modal-add-discount" tabindex="-1" role="dialog">
            <div class="modal-dialog" v-if="discountingUser">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            {{__('Add Discount')}} (@{{ discountingUser.name }})
                        </h5>
                    </div>

                    <div class="modal-body">
                        <!-- Current Discount -->
                        <div class="relative px-3 py-3 mb-4 border rounded text-green-darker border-green-dark bg-green-lighter" v-if="currentDiscount">
                            <span v-if="currentDiscount.duration=='repeating' && currentDiscount.duration_in_months > 1">@{{ __("This user has a discount of :discountAmount for all invoices during the next :months months.", {discountAmount: formattedDiscount(currentDiscount), months: currentDiscount.duration_in_months}) }}</span>
                            <span v-if="currentDiscount.duration=='repeating' && currentDiscount.duration_in_months == 1">@{{ __("This user has a discount of :discountAmount for all invoices during the next month.", {discountAmount: formattedDiscount(currentDiscount)}) }}</span>
                            <span v-if="currentDiscount.duration=='forever'">@{{ __("This user has a discount of :discountAmount forever.", {discountAmount: formattedDiscount(currentDiscount)}) }}</span>
                            <span v-if="currentDiscount.duration=='once'">@{{ __("This user has a discount of :discountAmount for a single invoice.", {discountAmount: formattedDiscount(currentDiscount)}) }}</span>
                        </div>

                        <!-- Add Discount Form -->
                        <form role="form">
                            <!-- Discount Type -->
                            <div class="mb-4 flex flex-wrap">
                                <label class="sm:w-1/4 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{__('Type')}}</label>

                                <div class="sm:w-2/3 pr-4 pl-4 pt-2">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" value="amount" v-model="form.type">&nbsp;&nbsp;{{__('Amount')}}
                                        </label>
                                    </div>

                                    <div class="radio">
                                        <label>
                                            <input type="radio" value="percent" v-model="form.type">&nbsp;&nbsp;{{__('Percentage')}}
                                        </label>
                                    </div>

                                    <span class="hidden mt-1 text-sm text-red" v-show="form.errors.has('type')">
                                        @{{ form.errors.get('type') }}
                                    </span>
                                </div>
                            </div>

                            <!-- Discount Value -->
                            <div class="mb-4 flex flex-wrap">
                                <label class="md:w-1/4 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">
                                    <span v-if="form.type == 'percent'">{{__('Percentage')}}</span>

                                    <span v-if="form.type == 'amount'">{{__('Amount')}}</span>
                                </label>

                                <div class="md:w-2/3 pr-4 pl-4">
                                    <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" v-model="form.value" :class="{'bg-red-dark': form.errors.has('value')}">

                                    <span class="hidden mt-1 text-sm text-red" v-show="form.errors.has('value')">
                                        @{{ form.errors.get('value') }}
                                    </span>
                                </div>
                            </div>

                            <!-- Discount Duration -->
                            <div class="mb-4 flex flex-wrap">
                                <label class="sm:w-1/4 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{__('Duration')}}</label>

                                <div class="sm:w-2/3 pr-4 pl-4 pt-2">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" value="once" v-model="form.duration">&nbsp;&nbsp;{{__('Once')}}
                                        </label>
                                    </div>

                                    <div class="radio">
                                        <label>
                                            <input type="radio" value="forever" v-model="form.duration">&nbsp;&nbsp;{{__('Forever')}}
                                        </label>
                                    </div>

                                    <div class="radio">
                                        <label>
                                            <input type="radio" value="repeating" v-model="form.duration">&nbsp;&nbsp;{{__('Multiple Months')}}
                                        </label>
                                    </div>

                                    <span class="hidden mt-1 text-sm text-red" v-show="form.errors.has('duration')">
                                        @{{ form.errors.get('duration') }}
                                    </span>
                                </div>
                            </div>

                            <!-- Duration Months -->
                            <div class="mb-4 flex flex-wrap" v-if="form.duration == 'repeating'">
                                <label class="md:w-1/4 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">
                                    {{__('Months')}}
                                </label>

                                <div class="md:w-2/3 pr-4 pl-4">
                                    <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" v-model="form.months" :class="{'bg-red-dark': form.errors.has('months')}">

                                    <span class="hidden mt-1 text-sm text-red" v-show="form.errors.has('months')">
                                        @{{ form.errors.get('months') }}
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline btn-default" data-dismiss="modal">{{__('Cancel')}}</button>

                        <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-blue-lightest bg-blue hover:bg-blue-light" @click="applyDiscount" :opacity-75="form.busy">
                            <span v-if="form.busy">
                                <i class="fa fa-btn fa-spinner fa-spin"></i> {{__('Applying')}}
                            </span>

                            <span v-else>
                                {{__('Apply Discount')}}
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</spark-kiosk-add-discount>
