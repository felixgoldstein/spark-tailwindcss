<spark-update-password inline-template>
    <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light card-default">
        <div class="py-3 px-6 mb-0 bg-grey-lighter border-b-1 border-grey-light text-grey-darkest">{{__('Update Password')}}</div>

        <div class="flex-auto p-6">
            <!-- Success Message -->
            <div class="relative px-3 py-3 mb-4 border rounded text-green-darker border-green-dark bg-green-lighter" v-if="form.successful">
                {{__('Your password has been updated!')}}
            </div>

            <form role="form">
                <!-- Current Password -->
                <div class="mb-4 flex flex-wrap">
                    <label class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{__('Current Password')}}</label>

                    <div class="md:w-1/2 pr-4 pl-4">
                        <input type="password" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" name="current_password" v-model="form.current_password" :class="{'bg-red-dark': form.errors.has('current_password')}">

                        <span class="hidden mt-1 text-sm text-red" v-show="form.errors.has('current_password')">
                            @{{ form.errors.get('current_password') }}
                        </span>
                    </div>
                </div>

                <!-- New Password -->
                <div class="mb-4 flex flex-wrap">
                    <label class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{__('Password')}}</label>

                    <div class="md:w-1/2 pr-4 pl-4">
                        <input type="password" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" name="password" v-model="form.password" :class="{'bg-red-dark': form.errors.has('password')}">

                        <span class="hidden mt-1 text-sm text-red" v-show="form.errors.has('password')">
                            @{{ form.errors.get('password') }}
                        </span>
                    </div>
                </div>

                <!-- New Password Confirmation -->
                <div class="mb-4 flex flex-wrap">
                    <label class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{__('Confirm Password')}}</label>

                    <div class="md:w-1/2 pr-4 pl-4">
                        <input type="password" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" name="password_confirmation" v-model="form.password_confirmation" :class="{'bg-red-dark': form.errors.has('password_confirmation')}">

                        <span class="hidden mt-1 text-sm text-red" v-show="form.errors.has('password_confirmation')">
                            @{{ form.errors.get('password_confirmation') }}
                        </span>
                    </div>
                </div>

                <!-- Update Button -->
                <div class="mb-4 flex flex-wrap mb-0">
                    <div class="md:w-1/2 pr-4 pl-4 md:mx-1/3">
                        <button type="submit" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-blue-lightest bg-blue hover:bg-blue-light"
                                @click.prevent="update"
                                :disabled="form.busy">

                            {{__('Update')}}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</spark-update-password>
