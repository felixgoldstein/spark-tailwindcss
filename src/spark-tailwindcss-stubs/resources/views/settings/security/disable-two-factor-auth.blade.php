<spark-disable-two-factor-auth :user="user" inline-template>
    <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light card-default">
        <div class="flex-auto p-6">
            <button class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-red-dark border-red bg-white hover:bg-red-light hover:text-red-darker" @click="disable" :opacity-75="form.busy">
                <span v-if="form.busy">
                    <i class="fa fa-btn fa-spinner fa-spin"></i> {{__('Disabling')}}
                </span>

                <span v-else>
                    {{__('Disable Two-Factor Authentication')}}
                </span>
            </button>
        </div>
    </div>
</spark-disable-two-factor-auth>
