@extends('layout.base')
@section('base_title','Not Found')
@section('base_body')
    {{isset($msg)?$msg:'Request valid !'}}
@endsection