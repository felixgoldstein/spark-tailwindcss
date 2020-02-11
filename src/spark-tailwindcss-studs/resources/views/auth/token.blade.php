@extends('spark::layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="flex flex-wrap justify-center">
        <div class="md:w-2/3 pr-4 pl-4">
            <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light card-default">
                <div class="py-3 px-6 mb-0 bg-grey-lighter border-b-1 border-grey-light text-grey-darkest">{{__('Two-Factor Authentication')}}</div>

                <div class="flex-auto p-6">
                    @include('spark::shared.errors')

                    <form role="form" method="POST" action="/login/token">
                        {{ csrf_field() }}

                        <!-- Token -->
                        <div class="mb-4 flex flex-wrap">
                            <label class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{__('Authentication Token')}}</label>

                            <div class="md:w-1/2 pr-4 pl-4">
                                <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" name="token" autofocus>
                            </div>
                        </div>

                        <!-- Verify Button -->
                        <div class="mb-4 flex flex-wrap">
                            <div class="md:w-1/2 pr-4 pl-4 md:mx-1/3">
                                <button type="submit" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-blue-lightest bg-blue hover:bg-blue-light">
                                    {{__('Verify')}}
                                </button>

                                <a class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline font-normal blue bg-transparent" href="{{ url('login-via-emergency-token') }}">
                                    {{__('Lost Your Device?')}}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
