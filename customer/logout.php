<?php

// Start sessions
if(!session_id()){ session_start();}

// Destroy the session and redirect to index.php
if (session_destroy()) {
    header('location: ../index.php');
}

?>