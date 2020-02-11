<form role="form">
    @if (Spark::usesTeams() && Spark::onlyTeamPlans())
        <!-- Team Name -->
        <div class="mb-4 flex flex-wrap" v-if=" ! invitation">
            <label class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{ __('teams.team_name') }}</label>

            <div class="md:w-1/2 pr-4 pl-4">
                <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" name="team" v-model="registerForm.team" :class="{'bg-red-dark': registerForm.errors.has('team')}" autofocus>

                <span class="hidden mt-1 text-sm text-red" v-show="registerForm.errors.has('team')">
                    @{{ registerForm.errors.get('team') }}
                </span>
            </div>
        </div>

        @if (Spark::teamsIdentifiedByPath())
            <!-- Team Slug (Only Shown When Using Paths For Teams) -->
            <div class="mb-4 flex flex-wrap" v-if=" ! invitation">
                <label class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{ __('teams.team_slug') }}</label>

                <div class="md:w-1/2 pr-4 pl-4">
                    <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" name="team_slug" v-model="registerForm.team_slug" :class="{'bg-red-dark': registerForm.errors.has('team_slug')}" autofocus>

                    <small class="block mt-1 text-grey" v-show="! registerForm.errors.has('team_slug')">
                        {{__('teams.slug_input_explanation')}}
                    </small>

                    <span class="hidden mt-1 text-sm text-red" v-show="registerForm.errors.has('team_slug')">
                        @{{ registerForm.errors.get('team_slug') }}
                    </span>
                </div>
            </div>
        @endif
    @endif

    <!-- Name -->
    <div class="mb-4 flex flex-wrap">
        <label class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{__('Name')}}</label>

        <div class="md:w-1/2 pr-4 pl-4">
            <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" name="name" v-model="registerForm.name" :class="{'bg-red-dark': registerForm.errors.has('name')}" autofocus>

            <span class="hidden mt-1 text-sm text-red" v-show="registerForm.errors.has('name')">
                @{{ registerForm.errors.get('name') }}
            </span>
        </div>
    </div>

    <!-- E-Mail Address -->
    <div class="mb-4 flex flex-wrap">
        <label class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{__('E-Mail Address')}}</label>

        <div class="md:w-1/2 pr-4 pl-4">
            <input type="email" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" name="email" v-model="registerForm.email" :class="{'bg-red-dark': registerForm.errors.has('email')}">

            <span class="hidden mt-1 text-sm text-red" v-show="registerForm.errors.has('email')">
                @{{ registerForm.errors.get('email') }}
            </span>
        </div>
    </div>

    <!-- Password -->
    <div class="mb-4 flex flex-wrap">
        <label class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{__('Password')}}</label>

        <div class="md:w-1/2 pr-4 pl-4">
            <input type="password" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" name="password" v-model="registerForm.password" :class="{'bg-red-dark': registerForm.errors.has('password')}">

            <span class="hidden mt-1 text-sm text-red" v-show="registerForm.errors.has('password')">
                @{{ registerForm.errors.get('password') }}
            </span>
        </div>
    </div>

    <!-- Password Confirmation -->
    <div class="mb-4 flex flex-wrap">
        <label class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{__('Confirm Password')}}</label>

        <div class="md:w-1/2 pr-4 pl-4">
            <input type="password" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" name="password_confirmation" v-model="registerForm.password_confirmation" :class="{'bg-red-dark': registerForm.errors.has('password_confirmation')}">

            <span class="hidden mt-1 text-sm text-red" v-show="registerForm.errors.has('password_confirmation')">
                @{{ registerForm.errors.get('password_confirmation') }}
            </span>
        </div>
    </div>

    <!-- Terms And Conditions -->
    <div v-if=" ! selectedPlan || selectedPlan.price == 0">
        <div class="mb-4 flex flex-wrap">
            <div class="md:w-1/2 pr-4 pl-4 md:mx-1/3">
                <div class="relative block mb-2">
                    <input type="checkbox" class="absolute mt-1 -ml-6" id="terms" :class="{'bg-red-dark': registerForm.errors.has('terms')}" v-model="registerForm.terms">
                    <label class="text-grey-dark pl-6 mb-0" for="terms">
                        {!! __('I Accept :linkOpen The Terms Of Service :linkClose', ['linkOpen' => '<a href="/terms" target="_blank">', 'linkClose' => '</a>']) !!}
                    </label>
                    <div class="hidden mt-1 text-sm text-red" v-show="registerForm.errors.has('terms')">
                        <strong>@{{ registerForm.errors.get('terms') }}</strong>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="mb-4 flex flex-wrap mb-0">
            <div class="md:w-1/2 pr-4 pl-4 md:mx-1/3">
                <button class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-blue-lightest bg-blue hover:bg-blue-light" @click.prevent="register" :opacity-75="registerForm.busy">
                    <span v-if="registerForm.busy">
                        <i class="fa fa-btn fa-spinner fa-spin"></i> {{__('Registering')}}
                    </span>

                    <span v-else>
                        <i class="fa fa-btn fa-check-circle"></i> {{__('Register')}}
                    </span>
                </button>
            </div>
        </div>
    </div>
</form>
