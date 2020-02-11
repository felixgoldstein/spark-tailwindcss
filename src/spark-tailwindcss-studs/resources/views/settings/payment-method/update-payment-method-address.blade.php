<!-- Address -->
<div class="mb-4 flex flex-wrap">
    <label class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{__('Address')}}</label>

    <div class="sm:w-1/2 pr-4 pl-4">
        <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" v-model="form.address" :class="{'bg-red-dark': form.errors.has('address')}">

        <span class="hidden mt-1 text-sm text-red" v-show="form.errors.has('address')">
            @{{ form.errors.get('address') }}
        </span>
    </div>
</div>

<!-- Address Line 2 -->
<div class="mb-4 flex flex-wrap">
    <label class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{__('Address Line 2')}}</label>

    <div class="sm:w-1/2 pr-4 pl-4">
        <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" v-model="form.address_line_2" :class="{'bg-red-dark': form.errors.has('address_line_2')}">

        <span class="hidden mt-1 text-sm text-red" v-show="form.errors.has('address_line_2')">
            @{{ form.errors.get('address_line_2') }}
        </span>
    </div>
</div>

<!-- City -->
<div class="mb-4 flex flex-wrap">
    <label class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{__('City')}}</label>

    <div class="sm:w-1/2 pr-4 pl-4">
        <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" v-model="form.city" :class="{'bg-red-dark': form.errors.has('city')}">

        <span class="hidden mt-1 text-sm text-red" v-show="form.errors.has('city')">
            @{{ form.errors.get('city') }}
        </span>
    </div>
</div>

<!-- State & ZIP Code -->
<div class="mb-4 flex flex-wrap">
    <label class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{__('State & ZIP / Postal Code')}}</label>

    <!-- State -->
    <div class="sm:w-1/4 pr-4 pl-4">
        <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" v-model="form.state" placeholder="{{__('State')}}" :class="{'bg-red-dark': form.errors.has('state')}">

        <span class="hidden mt-1 text-sm text-red" v-show="form.errors.has('state')">
            @{{ form.errors.get('state') }}
        </span>
    </div>

    <!-- Zip Code -->
    <div class="sm:w-1/4 pr-4 pl-4">
        <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" v-model="form.zip" placeholder="{{__('Postal Code')}}" :class="{'bg-red-dark': form.errors.has('zip')}">

        <span class="hidden mt-1 text-sm text-red" v-show="form.errors.has('zip')">
            @{{ form.errors.get('zip') }}
        </span>
    </div>
</div>

<!-- Country -->
<div class="mb-4 flex flex-wrap">
    <label class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{__('Country')}}</label>

    <div class="sm:w-1/2 pr-4 pl-4">
        <select class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" v-model="form.country" :class="{'bg-red-dark': form.errors.has('country')}">
            @foreach (app(Laravel\Spark\Repositories\Geography\CountryRepository::class)->all() as $key => $country)
                <option value="{{ $key }}">{{ $country }}</option>
            @endforeach
        </select>

        <span class="hidden mt-1 text-sm text-red" v-show="form.errors.has('country')">
            @{{ form.errors.get('country') }}
        </span>
    </div>
</div>
