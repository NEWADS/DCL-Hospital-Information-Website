<? 
	header("Content-type:text/html;charset=utf-8");
    /**
     * logout.php
     *
     * A simple logout module for all of our login modules.
     *
     * David J. Malan
     * Computer Science S-75
     * Harvard Summer School
     */

    // enable sessions
    session_start();

    // delete cookies, if any
    setcookie("username", "", time() - 3600);
    setcookie("password", "", time() - 3600);

    // log user out
    setcookie(session_name(), "", time() - 3600);
    session_destroy();
	
	echo "<script> alert('注销成功');window.location.href='index.html';</script>";
?>
