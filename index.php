<?php

// redirects to public
header('Location: ' . $_SERVER['REQUEST_URI'] . 'public');
die();