@extends('spark::layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="flex flex-wrap justify-center">
        <div class="md:w-2/3 pr-4 pl-4">
            <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light card-default">
                <div class="py-3 px-6 mb-0 bg-grey-lighter border-b-1 border-grey-light text-grey-darkest">{{__('Login Via Emergency Token')}}</div>

                <div class="flex-auto p-6">
                    @include('spark::shared.errors')

                    <!-- Warning Message -->
                    <div class="relative px-3 py-3 mb-4 border rounded text-yellow-darker border-yellow-dark bg-yellow-lighter">
                        {{__('After logging in via your emergency token, two-factor authentication will be disabled for your account. If you would like to maintain two-factor authentication security, you should re-enable it after logging in.')}}
                    </div>

                    <form role="form" method="POST" action="/login-via-emergency-token">
                        {{ csrf_field() }}

                        <!-- Emergency Token -->
                        <div class="mb-4 flex flex-wrap">
                            <label class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{__('Emergency Token')}}</label>

                            <div class="md:w-1/2 pr-4 pl-4">
                                <input type="password" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" name="token" autofocus>
                            </div>
                        </div>

                        <!-- Emergency Token Login Button -->
                        <div class="mb-4 flex flex-wrap">
                            <div class="md:w-2/3 pr-4 pl-4 md:mx-1/3">
                                <button type="submit" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-blue-lightest bg-blue hover:bg-blue-light">
                                    {{__('Login')}}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
