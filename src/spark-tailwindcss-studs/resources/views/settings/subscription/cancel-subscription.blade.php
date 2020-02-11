<spark-cancel-subscription :user="user" :team="team" :billable-type="billableType" inline-template>
    <div>
        <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light card-default">
            <div class="flex-auto p-6">
                <button class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-red-dark border-red bg-white hover:bg-red-light hover:text-red-darker"
                @click="confirmCancellation"
                :disabled="form.busy">

                {{__('Cancel Subscription')}}
                </button>
            </div>
        </div>

        <!-- Confirm Cancellation Modal -->
        <div class="modal" id="modal-confirm-cancellation" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            {{__('Cancel Subscription')}}
                        </h5>
                    </div>

                    <div class="modal-body">
                        {{__('Are you sure you want to cancel your subscription?')}}
                    </div>

                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline btn-default" data-dismiss="modal">{{__('No, Go Back')}}</button>

                        <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-red-lightest bg-red hover:bg-red-light" @click="cancel" :opacity-75="form.busy">
                        <span v-if="form.busy">
                            <i class="fa fa-btn fa-spinner fa-spin"></i> {{__('Cancelling')}}
                        </span>

                        <span v-else>
                            {{__('Yes, Cancel')}}
                        </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</spark-cancel-subscription>
