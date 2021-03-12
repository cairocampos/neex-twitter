@extends('layouts.app')

@section('content')
<div class="ui main text container">
  <feed-component></feed-component>
  <profiles-component :user="{{auth()->user()}}"></profiles-component>
</div>
@endsection