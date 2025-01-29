@extends('testmodule::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! _clean(config('testmodule.name')) !!}
    </p>
@endsection
