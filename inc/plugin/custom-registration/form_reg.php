
<?php

//  создаем функцию PHP, которая содержит HTML-код регистрационной формы.
function registration_form( $username, $password, $email, $city, $mobile, $website, $first_name, $last_name, $nickname, $bio ) {
    echo '
    <style>
	div {
		margin-bottom:2px;
	}
	
	input{
		margin-bottom:4px;
	}
	</style>
	';

    echo '
    <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
	<div>
	<label for="username">Username <strong>*</strong></label>
	<input type="text" name="username" value="' . (isset($_POST['username']) ? $username : null) . '">
	</div>
	
	<div>
	<label for="password">Password <strong>*</strong></label>
	<input type="password" name="password" value="' . (isset($_POST['password']) ? $password : null) . '">
	</div>
	
	<div>
	<label for="email">Email <strong>*</strong></label>
	<input type="text" name="email" value="' . (isset($_POST['email']) ? $email : null) . '">
    </div>
    
    <div>
	<label for="city">Город</label>
	<input type="text" name="city" value="' . (isset($_POST['city']) ? $city : null) . '">
    </div>
    
    <div>
	<label for="mobile">Телефон</label>
	<input type="text" name="mobile" value="' . (isset($_POST['mobile']) ? $mobile : null) . '">
	</div>
	
	<div>
	<label for="website">Website</label>
	<input type="text" name="website" value="' . (isset($_POST['website']) ? $website : null) . '">
	</div>
	
	<div>
	<label for="firstname">First Name</label>
	<input type="text" name="fname" value="' . (isset($_POST['fname']) ? $first_name : null) . '">
	</div>
	
	<div>
	<label for="website">Last Name</label>
	<input type="text" name="lname" value="' . (isset($_POST['lname']) ? $last_name : null) . '">
	</div>
	
	<div>
	<label for="nickname">Nickname</label>
	<input type="text" name="nickname" value="' . (isset($_POST['nickname']) ? $nickname : null) . '">
	</div>
	
	<div>
	<label for="bio">About / Bio</label>
	<textarea name="bio">' . (isset($_POST['bio']) ? $bio : null) . '</textarea>
	</div>
	<input type="submit" name="submit" value="Register"/>
	</form>
	';
}
