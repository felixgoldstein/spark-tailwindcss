<!-- Customer Support -->
<div class="modal opacity-0" id="modal-support" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form role="form">
                    <!-- From -->
                    <div class="mb-4" :class="{'bg-red-dark': supportForm.errors.has('from')}">
                        <input id="support-from" type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" v-model="supportForm.from" placeholder="{{__('Your Email Address')}}">

                        <span class="hidden mt-1 text-sm text-red" v-show="supportForm.errors.has('from')">
                            @{{ supportForm.errors.get('from') }}
                        </span>
                    </div>

                    <!-- Subject -->
                    <div class="mb-4" :class="{'bg-red-dark': supportForm.errors.has('subject')}">
                        <input id="support-subject" type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" v-model="supportForm.subject" placeholder="{{__('Subject')}}">

                        <span class="hidden mt-1 text-sm text-red" v-show="supportForm.errors.has('subject')">
                            @{{ supportForm.errors.get('subject') }}
                        </span>
                    </div>

                    <!-- Message -->
                    <div class="mb-4" :class="{'bg-red-dark': supportForm.errors.has('message')}">
                        <textarea class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" rows="7" v-model="supportForm.message" placeholder="{{__('Message')}}"></textarea>

                        <span class="hidden mt-1 text-sm text-red" v-show="supportForm.errors.has('message')">
                            @{{ supportForm.errors.get('message') }}
                        </span>
                    </div>
                </form>
            </div>

            <!-- Modal Actions -->
            <div class="modal-footer border-none">
                <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-blue-lightest bg-blue hover:bg-blue-light" @click.prevent="sendSupportRequest" :opacity-75="supportForm.busy">
                    <i class="fa fa-btn fa-paper-plane"></i> {{__('Send')}}
                </button>
            </div>
        </div>
    </div>
</div>
