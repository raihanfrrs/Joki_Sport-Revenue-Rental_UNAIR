@extends('layouts.renter')

@section('section-auth')

<div class="login-card">
    <h1>Welcome!</h1><br>
    <form action="/registrasi" method="POST">
        @csrf
        <input class="text" type="text" name="name" id="name" placeholder="Name" required="yes">
        <select name="peran" type="text email" class="text email">
            <option value="pelanggan">Pelanggan</option>
            <option value="owner">Owner</option>
        </select>				
        <input class="text" type="email" name="email" id="email" placeholder="name@example.com" required="">
        <input class="text w3lpass" type="password" name="password" id="password" placeholder="Password" required="">
        <input type="submit" value="SIGNUP" name="submit">
    </form>

    <div class="login-help">
        <p>Already have an Account? <a href="{{ route('login.renter') }}"> Login Now!</a></p>
    </div>
</div>

@endsection