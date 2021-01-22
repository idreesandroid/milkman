@extends('layouts.master')
@section('content')
<?php

$data = session()->all();


print_r($data);

?>


@endsection