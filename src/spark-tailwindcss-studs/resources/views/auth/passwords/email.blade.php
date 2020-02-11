@extends('spark::layouts.app')

<!-- Main Content -->
@section('content')
<div class="container mx-auto">
    <div class="flex flex-wrap justify-center">
        <div class="lg:w-2/3 pr-4 pl-4">
            <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light card-default">
                <div class="py-3 px-6 mb-0 bg-grey-lighter border-b-1 border-grey-light text-grey-darkest">{{__('Reset Password')}}</div>

                <div class="flex-auto p-6">
                    @if (session('status'))
                        <div class="relative px-3 py-3 mb-4 border rounded text-green-darker border-green-dark bg-green-lighter">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form role="form" method="POST" action="{{ url('/password/email') }}">
                        @csrf

                        <!-- E-Mail Address -->
                        <div class="mb-4 flex flex-wrap">
                            <label class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{__('E-Mail Address')}}</label>

                            <div class="md:w-1/2 pr-4 pl-4">
                                <input type="email" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded{{ $errors->has('email') ? ' bg-red-dark' : '' }}" name="email" value="{{ old('email') }}" autofocus>

                                @if ($errors->has('email'))
                                    <span class="hidden mt-1 text-sm text-red">
                                        {{ $errors->first('email') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Send Password Reset Link Button -->
                        <div class="mb-4 flex flex-wrap mb-0">
                            <div class="md:w-1/2 pr-4 pl-4 md:mx-1/3">
                                <button type="submit" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-blue-lightest bg-blue hover:bg-blue-light">
                                    <i class="fa fa-btn fa-envelope"></i> {{__('Send Password Reset Link')}}
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
