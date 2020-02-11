<!-- Address -->
<div class="mb-4 flex flex-wrap">
    <label class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{__('Address')}}</label>

    <div class="sm:w-1/2 pr-4 pl-4">
        <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" v-model="registerForm.address" lazy :class="{'bg-red-dark': registerForm.errors.has('address')}">

        <span class="hidden mt-1 text-sm text-red" v-show="registerForm.errors.has('address')">
            @{{ registerForm.errors.get('address') }}
        </span>
    </div>
</div>

<!-- Address Line 2 -->
<div class="mb-4 flex flex-wrap">
    <label class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{__('Address Line 2')}}</label>

    <div class="sm:w-1/2 pr-4 pl-4">
        <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" v-model="registerForm.address_line_2" lazy :class="{'bg-red-dark': registerForm.errors.has('address_line_2')}">

        <span class="hidden mt-1 text-sm text-red" v-show="registerForm.errors.has('address_line_2')">
            @{{ registerForm.errors.get('address_line_2') }}
        </span>
    </div>
</div>

<!-- City -->
<div class="mb-4 flex flex-wrap">
    <label class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{__('City')}}</label>

    <div class="sm:w-1/2 pr-4 pl-4">
        <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" v-model.lazy="registerForm.city" :class="{'bg-red-dark': registerForm.errors.has('city')}">

        <span class="hidden mt-1 text-sm text-red" v-show="registerForm.errors.has('city')">
            @{{ registerForm.errors.get('city') }}
        </span>
    </div>
</div>

<!-- State & ZIP Code -->
<div class="mb-4 flex flex-wrap">
    <label class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{__('State & ZIP / Postal Code')}}</label>

    <!-- State -->
    <div class="sm:w-1/4 pr-4 pl-4">
        <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" placeholder="{{__('State')}}" v-model.lazy="registerForm.state" :class="{'bg-red-dark': registerForm.errors.has('state')}">

        <span class="hidden mt-1 text-sm text-red" v-show="registerForm.errors.has('state')">
            @{{ registerForm.errors.get('state') }}
        </span>
    </div>

    <!-- Zip Code -->
    <div class="sm:w-1/4 pr-4 pl-4">
        <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" placeholder="{{__('Postal Code')}}" v-model.lazy="registerForm.zip" :class="{'bg-red-dark': registerForm.errors.has('zip')}">

        <span class="hidden mt-1 text-sm text-red" v-show="registerForm.errors.has('zip')">
            @{{ registerForm.errors.get('zip') }}
        </span>
    </div>
</div>

<!-- Country -->
<div class="mb-4 flex flex-wrap">
    <label class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{__('Country')}}</label>

    <div class="sm:w-1/2 pr-4 pl-4">
        <select class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" v-model.lazy="registerForm.country" :class="{'bg-red-dark': registerForm.errors.has('country')}">
            @foreach (app(Laravel\Spark\Repositories\Geography\CountryRepository::class)->all() as $key => $country)
                <option value="{{ $key }}">{{ $country }}</option>
            @endforeach
        </select>

        <span class="hidden mt-1 text-sm text-red" v-show="registerForm.errors.has('country')">
            @{{ registerForm.errors.get('country') }}
        </span>
    </div>
</div>

<!-- European VAT ID -->
<div class="mb-4 flex flex-wrap" v-if="countryCollectsVat">
    <label class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{__('VAT ID')}}</label>

    <div class="sm:w-1/2 pr-4 pl-4">
        <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" v-model.lazy="registerForm.vat_id" :class="{'bg-red-dark': registerForm.errors.has('vat_id')}">

        <span class="hidden mt-1 text-sm text-red" v-show="registerForm.errors.has('vat_id')">
            @{{ registerForm.errors.get('vat_id') }}
        </span>
    </div>
</div>
