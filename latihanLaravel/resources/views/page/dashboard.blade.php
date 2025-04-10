@extends('layouts.master')

@section('latihanLaravel')
    Thank You!
@endsection

@section('content')

    <h1>Hii, Welcome {{$firstname}} {{$lastname}}!</h1> <br>
    <h2>Terima Kasih telah bergabung di SanberBook. Social Media kita bersama!</h2> <br><br>
    <p>Alamat Anda berada di {{$address}}</p>

@endsection