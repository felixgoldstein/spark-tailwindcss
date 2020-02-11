@if (count($errors) > 0)
    <div class="relative px-3 py-3 mb-4 border rounded text-red-darker border-red-dark bg-red-lighter">
        <strong>{{__('Whoops!')}}</strong> {{__('Something went wrong!')}}
        <br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
