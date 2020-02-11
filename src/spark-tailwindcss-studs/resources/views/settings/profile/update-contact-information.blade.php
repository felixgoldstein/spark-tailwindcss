<spark-update-contact-information :user="user" inline-template>
    <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light card-default">
        <div class="py-3 px-6 mb-0 bg-grey-lighter border-b-1 border-grey-light text-grey-darkest">{{__('Contact Information')}}</div>

        <div class="flex-auto p-6">
            <!-- Success Message -->
            <div class="relative px-3 py-3 mb-4 border rounded text-green-darker border-green-dark bg-green-lighter" v-if="form.successful">
                {{__('Your contact information has been updated!')}}
            </div>

            <form role="form">
                <!-- Name -->
                <div class="mb-4 flex flex-wrap">
                    <label class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{__('Name')}}</label>

                    <div class="md:w-1/2 pr-4 pl-4">
                        <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" name="name" v-model="form.name" :class="{'bg-red-dark': form.errors.has('name')}">

                        <span class="hidden mt-1 text-sm text-red" v-show="form.errors.has('name')">
                            @{{ form.errors.get('name') }}
                        </span>
                    </div>
                </div>

                <!-- E-Mail Address -->
                <div class="mb-4 flex flex-wrap">
                    <label class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{__('E-Mail Address')}}</label>

                    <div class="md:w-1/2 pr-4 pl-4">
                        <input type="email" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" name="email" v-model="form.email" :class="{'bg-red-dark': form.errors.has('email')}">

                        <span class="hidden mt-1 text-sm text-red" v-show="form.errors.has('email')">
                            @{{ form.errors.get('email') }}
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
</spark-update-contact-information>
