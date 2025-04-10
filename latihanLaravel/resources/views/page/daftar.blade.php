@extends('layouts.master')

@section('latihanLaravel')
    Register
@endsection

@section('content')

<h1>Register New Account</h1>
<form action="/welcome" method="POST">
    @csrf
    <label>First Name:</label> <br>
    <input type="text" name="firstname"> <br> <br>
    <label>Last Name:</label> <br>
    <input type="text" name="lastname"> <br> <br>

    <label>Gender:</label> <br><br>
        <input type="radio" name="Gender:">Male <br>
        <input type="radio" name="Gender:">Female <br>
        <input type="radio" name="Gender:">Other <br><br>

    <label>Nationality:</label> <br><br>
    <select name="Nationality:"> 
        <option value="">Indonesian</option>
        <option value="">America</option>
        <option value="">China</option>
        <option value="">Russia</option>
    </select> <br><br>

    <label>Language Spoken:</label> <br><br>
        <input type="checkbox" name="Language Spoken:">Bahasa Indonesia <br>
        <input type="checkbox" name="Language Spoken:">English <br>
        <input type="checkbox" name="Language Spoken:">Other <br><br>

    <label>Address:</label> <br>
    <textarea name="address" cols="30" rows="10"></textarea> <br> <br>

    <input type="submit" value="Daftar"> <br> <br>
</form>
<a href="/">< Back</a>

@endsection