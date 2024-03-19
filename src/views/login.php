<?php $this->layout('master'); ?>

<h2>login</h2>

<form action="/login" method="POST">
    <input type="text" name="email" value="test@gmail.com">
    <input type="password" name="password" value="123">
    <button type="submit">Login</button>
</form>