<spark-tokens :tokens="tokens" :available-abilities="availableAbilities" inline-template>
    <div>
        <div>
            <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light card-default" v-if="tokens.length > 0">
                <div class="py-3 px-6 mb-0 bg-grey-lighter border-b-1 border-grey-light text-grey-darkest">{{__('API Tokens')}}</div>

                <div class="block w-full overflow-auto scrolling-touch">
                    <table class="w-full max-w-full mb-4 bg-transparent table-valign-middle mb-0">
                        <thead>
                            <tr>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Created')}}</th>
                                <th>{{__('Last Used')}}</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>

                        <tbody>
                        <tr v-for="token in tokens">
                            <!-- Name -->
                            <td>
                                <div>
                                    @{{ token.name }}
                                </div>
                            </td>

                            <!-- Created At -->
                            <td>
                                <div>
                                    @{{ token.created_at | datetime }}
                                </div>
                            </td>

                            <!-- Last Used At -->
                            <td>
                                <div>
                                        <span v-if="token.last_used_at">
                                            @{{ token.last_used_at | datetime }}
                                        </span>

                                        <span v-else>
                                            {{__('Never')}}
                                        </span>
                                </div>
                            </td>

                            <!-- Edit Button -->
                            <td class="td-fit">
                                <div class="text-right ">
                                    <button class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-blue-dark border-blue bg-white hover:bg-blue-light hover:text-blue-darker" @click="editToken(token)">
                                        <i class="fa fa-cog"></i>
                                    </button>

                                    <button class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-red-dark border-red bg-white hover:bg-red-light hover:text-red-darker" @click="approveTokenDelete(token)">
                                        <i class="fa fa-remove"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Update Token Modal -->
        <div class="modal" id="modal-update-token" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-md" v-if="updatingToken">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            {{__('Edit Token')}} (@{{ updatingToken.name }})
                        </h5>
                    </div>

                    <div class="modal-body">
                        <!-- Update Token Form -->
                        <form role="form">
                            <!-- Token Name -->
                            <div class="mb-4 flex flex-wrap">
                                <label class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{__('Token Name')}}</label>

                                <div class="md:w-1/2 pr-4 pl-4">
                                    <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" name="name" v-model="updateTokenForm.name" :class="{'bg-red-dark': updateTokenForm.errors.has('name')}">

                                    <span class="hidden mt-1 text-sm text-red" v-show="updateTokenForm.errors.has('name')">
                                        @{{ updateTokenForm.errors.get('name') }}
                                    </span>
                                </div>
                            </div>

                            <!-- Token Abilities -->
                            <div class="mb-4 flex flex-wrap" v-if="availableAbilities.length > 0">
                                <label class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{__('Token Can')}}</label>

                                <div class="md:w-1/2 pr-4 pl-4">
                                    <div v-for="ability in availableAbilities">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"
                                                @click="toggleAbility(ability.value)"
                                                :checked="abilityIsAssigned(ability.value)">

                                                @{{ ability.name }}
                                            </label>
                                        </div>
                                    </div>

                                    <span class="hidden mt-1 text-sm text-red" v-show="updateTokenForm.errors.has('abilities')">
                                        @{{ updateTokenForm.errors.get('abilities') }}
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline btn-default" data-dismiss="modal">{{__('absolute pin-t pin-b pin-r px-4 py-3')}}</button>

                        <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-blue-lightest bg-blue hover:bg-blue-light" @click="updateToken" :opacity-75="updateTokenForm.busy">
                        {{__('Update')}}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Token Modal -->
        <div class="modal" id="modal-delete-token" tabindex="-1" role="dialog">
            <div class="modal-dialog" v-if="deletingToken">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            {{__('Delete Token')}} (@{{ deletingToken.name }})
                        </h5>
                    </div>

                    <div class="modal-body">
                        {{__('Are you sure you want to delete this token? If deleted, API requests that attempt to authenticate using this token will no longer be accepted.')}}
                    </div>

                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline btn-default" data-dismiss="modal">{{__('No, Go Back')}}</button>

                        <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-red-lightest bg-red hover:bg-red-light" @click="deleteToken" :opacity-75="deleteTokenForm.busy">
                        {{__('Yes, Delete')}}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</spark-tokens>
