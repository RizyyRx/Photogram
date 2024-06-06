<?php
$login_page=true;
//TODO: Redirect to a requested URL instead of base path on login_page
if(isset($_POST['email_addr']) and isset($_POST['pass'])){
  $email_address=$_POST['email_addr'];
  $password=$_POST['pass'];

  $result=UserSession::authenticate($email_address,$password);
  $login_page=false;
}

if(!$login_page){
  if($result){
    $should_redirect = Session::get('_redirect');//if user requested a page, then they are redirected to it(it is set on ensureLogin() on session class)
    $redirect_to = get_config('base_path');//acts as default redirect path
    if (isset($should_redirect)) {
        $redirect_to = $should_redirect;
      Session::set('_redirect', false);
    }

    ?>
   <script>window.location.href = "<?=$redirect_to?>"</script>
   <?

  }
  else{
?>
    ?>
		<script>
			window.location.href = "/login.php?error=1"
		</script>
		
		<?php

  }
}
else{
?>

  <main class="form-signin w-100 m-auto">
    <form method="post" action="login.php">
      <img class="ms-1 mb-3" src="/app/maeve 3.png" alt="image here" height="150">
      <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
      <?
		if(isset($_GET['error'])){
			?>
			<div class="alert alert-danger" role="alert">
				Invalid Credentials
			</div>
			<?
		}
		?>

      <div class="form-floating">
        <input name="email_addr" type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
        <label for="floatingInput">Email address or Username</label>
      </div>
      <div class="form-floating">
        <input name="pass" type="password" class="form-control" id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">Password</label>
      </div>
      <input name="fingerprint" type="hidden" id="fingerprint" value="">

      <div class="form-check text-start my-3">
        <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
        <label class="form-check-label" for="flexCheckDefault">
          Remember me
        </label>
      </div>
      <button class="btn btn-primary w-100 py-2 hvr-buzz-out" type="submit">Sign in</button>
      <a href="/signup.php" class="w-100 btn btn-link">Not registered? Sign up</a>
    </form>
  </main>
<?
}
?>