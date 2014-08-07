<?php
/* app/validators.php  */
 
Validator::extend('alpha_spaces', function($attribute, $value)
{
	return preg_match('/^[\pL\s]+$/u', $value);
});
 
Validator::extend('alpha_num_spaces', function($attribute, $value)
{
	return preg_match('/^[A-Za-z0-9 ]+$/u', $value);
});
 
Validator::extend('valid_file_name', function($attribute, $value)
{
	return preg_match('/^[A-Za-z0-9\-\._ ]+$/u', $value);
});
 
Validator::extend('username', function($attribute, $value)
{
	return preg_match('/^[A-Za-z0-9\._ ]+$/u', $value);
});
 
Validator::extend('printable_ascii', function($attribute, $value)
{
	return preg_match('/^[\x20-\x7F]+$/u', $value);
});