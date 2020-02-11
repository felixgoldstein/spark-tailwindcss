@extends('spark::layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="flex flex-wrap justify-center">
        <div class="md:w-2/3 pr-4 pl-4">
            <div class="intro mt-5">
                <div class="intro-img">
                    <img src="{{asset('/img/create-team.svg')}}" class="h-90" alt="{{__('Create Team')}}" />
                </div>
                <h4>
                    {{__('teams.wheres_your_team')}}
                </h4>
                <p class="intro-copy">
                    {{__('teams.looks_like_you_are_not_part_of_team')}}
                </p>
                <div class="intro-btn">
                    <a href="/settings#/{{ Spark::teamsPrefix() }}" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-black-dark border-black bg-white hover:bg-black-light hover:text-black-darker">
                        {{__('teams.create_team')}}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
