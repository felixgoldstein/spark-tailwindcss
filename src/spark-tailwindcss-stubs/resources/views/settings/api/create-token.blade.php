<spark-create-token :available-abilities="availableAbilities" inline-template>
    <div>
        <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light card-default">
            <div class="py-3 px-6 mb-0 bg-grey-lighter border-b-1 border-grey-light text-grey-darkest">
                {{__('Create API Token')}}
            </div>

            <div class="flex-auto p-6">
                <form role="form">
                    <!-- Token Name -->
                    <div class="mb-4 flex flex-wrap">
                        <label class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{__('Token Name')}}</label>

                        <div class="md:w-1/2 pr-4 pl-4">
                            <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" name="name" v-model="form.name"  :class="{'bg-red-dark': form.errors.has('name')}">

                            <span class="hidden mt-1 text-sm text-red" v-show="form.errors.has('name')">
                                @{{ form.errors.get('name') }}
                            </span>
                        </div>
                    </div>

                    <!-- Token Abilities -->
                    <div class="mb-4 flex flex-wrap" v-if="availableAbilities.length > 0">
                        <label class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{__('Token Can')}}</label>

                        <div class="md:w-1/2 pr-4 pl-4">
                            <div class="mb-2">
                                <button class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline btn-default" @click.prevent="assignAllAbilities" v-if=" ! allAbilitiesAssigned">
                                    <i class="fa fa-btn fa-check"></i> {{__('Assign All Abilities')}}
                                </button>

                                <button class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline btn-default" @click.prevent="removeAllAbilities" v-if="allAbilitiesAssigned">
                                    <i class="fa fa-btn fa-times"></i> {{__('Remove All Abilities')}}
                                </button>
                            </div>

                            <div v-for="ability in availableAbilities">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"
                                            @click="toggleAbility(ability.value)"
                                            :class="{'bg-red-dark': form.errors.has('abilities')}"
                                            :checked="abilityIsAssigned(ability.value)">

                                            @{{ ability.name }}
                                    </label>
                                </div>
                            </div>

                            <span class="hidden mt-1 text-sm text-red" v-show="form.errors.has('abilities')">
                                @{{ form.errors.get('abilities') }}
                            </span>
                        </div>
                    </div>

                    <!-- Create Button -->
                    <div class="mb-4 flex flex-wrap mb-0">
                        <div class="md:mx-1/3 md:w-1/2 pr-4 pl-4">
                            <button type="submit" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-blue-lightest bg-blue hover:bg-blue-light"
                                    @click.prevent="create"
                                    :disabled="form.busy">

                                {{__('Create')}}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Show Token Modal -->
        <div class="modal" id="modal-show-token" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" v-if="showingToken">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            {{__('API Token')}}
                        </h5>
                    </div>

                    <div class="modal-body">
                        <div class="relative px-3 py-3 mb-4 border rounded text-yellow-darker border-yellow-dark bg-yellow-lighter">
                            {{__('Here is your new API token.')}}
                             <strong>{{__('This is the only time the token will ever be displayed, so be sure not to lose it!')}}</strong>
                            {{__('You may revoke the token at any time from your API settings.')}}
                        </div>

                        <textarea id="api-token" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded"
                                  @click="selectToken"
                                  rows="5">@{{ showingToken }}</textarea>
                    </div>

                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-blue-lightest bg-blue hover:bg-blue-light" @click="selectToken">
                        <span v-if="copyCommandSupported">{{__('Copy To Clipboard')}}</span>
                        <span v-else>{{__('Select All')}}</span>
                        </button>
                        <button type="button" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline btn-default" data-dismiss="modal">{{__('absolute pin-t pin-b pin-r px-4 py-3')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</spark-create-token>
