<?php
/**
 * The expected Password as SHA1 String
 * Replace the second parameter with your SHA1 hashed password
 */
define('SHA1PASSWORD', 'be32d86e6c63566214e1340a450ea32c09c2717c');



/**
 * Class PasswordProtection
 * Password Protection Plugin for Adminer
 * Replaces or better extends Adminers LoginForm() Method
 * @author Florian Brinker
 */
class PasswordProtection {

	/**
	 * Load the current session variable at startup
	 */
	public function __construct() {
		$this->authed = false;

		if(isset($_SESSION['PasswordProtection']) && isset($_SESSION['PasswordProtection']['authed'])) {
			$this->authed = (bool)$_SESSION['PasswordProtection']['authed'];
		}
	}

	/**
	 * Update the Session variable
	 * @param $val
	 */
	private function ppUpdateSession($val) {
		$_SESSION['PasswordProtection']['authed'] = $val;
	}

	/**
	 * Auth the current user session
	 */
	private function ppLogin() {
		$this->authed = true;
		$this->ppUpdateSession(true);
	}

	/**
	 * Deauth the current session
	 */
	private function ppLogoff() {
		$this->authed = false;
		$this->ppUpdateSession(false);
	}

	/**
	 * Echo the login form
	 */
	private function ppEchoLoginForm() {
		echo '<div style="text-align: center; background-color: #eee; padding: 50px; border: 1px solid #999; margin: 0px 30px 0px 20px;">
			<form name="ppLoginForm" method="POST">
				<h3 style="margin: 0px 0px 25px;">Password Protected Area</h3>
				<label for="ppPassword">Password:</label>
				<input type="password" id="ppPassword" name="ppPassword">
				<button type="submit">Login</button>
			</form>
			<script type="text/javascript" language="JavaScript">
				window.onload = function() {
					document.getElementById("ppPassword").focus();
				}
			</script>
		</div>';
	}

	/**
	 * Change Adminers LoginForm Method
	 * LoginForm returns null, so the output isn't replacable, so the exit is neccessary to stop the
	 * original LoginForm() method
	 */
	public function loginForm() {
		if(!$this->authed) {
			// not authenticated
			if(!isset($_POST['ppPassword']) || (isset($_POST['ppPassword']) && sha1($_POST['ppPassword']) !== SHA1PASSWORD)) {
				$this->ppEchoLoginForm();
				exit(); // needed to prevent echoing the normal LoginForm() output
			}
			else { // password is okay, continue as expected
				$this->ppLogin();
				unset($_POST['ppPassword']);
			}
		}
		else {
			// returning to the login screen? possibly triggered by a logoff or a new user
			$this->ppLogoff();
		}
	}

}

