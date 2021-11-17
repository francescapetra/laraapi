@extends('errors::minimal')
{{$exception->getMessage()}}
@section('title', __('Not Found'))
@section('code', '404')
@section('message', __('Not Found'))
