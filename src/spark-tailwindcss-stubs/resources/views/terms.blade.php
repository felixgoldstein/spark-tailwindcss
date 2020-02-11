@extends('spark::layouts.app')

@section('content')
<div class="container mx-auto">
    <!-- Terms of Service -->
    <div class="flex flex-wrap justify-center">
        <div class="lg:w-2/3 pr-4 pl-4">
            <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light card-default">
                <div class="py-3 px-6 mb-0 bg-grey-lighter border-b-1 border-grey-light text-grey-darkest">{{__('Terms Of Service')}}</div>

                <div class="flex-auto p-6 terms-of-service">
                    {!! $terms !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
