<?php
$login=true;
//TODO: Redirect to a requested URL instead of base path on login
if(isset($_POST['email_addr']) and isset($_POST['pass'])){
  $email_address=$_POST['email_addr'];
  $password=$_POST['pass'];

  $result=UserSession::authenticate($email_address,$password);
  $login=false;
}

if(!$login){
  if($result){
    ?>
   <script>window.location.href = "<?=get_config('base_path')?>"</script>
   <?

  }
  else{
?>
    <main class="container">
      <div class="bg-body-tertiary p-5 rounded mt-3">
        <h1>Login failed</h1>
        <p class="lead">This example to understand how login works with html forms</p>
        <a class="btn btn-lg btn-primary" href="/docs/5.3/components/navbar/" role="button">View navbar docs »</a>
      </div>
    </main>
    <?php
  }
}
else{
?>

  <main class="form-signin w-100 m-auto">
    <form method="post" action="login.php">
      <img class="ms-1 mb-3" src="/app/maeve 3.png" alt="image here" height="150">
      <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

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
    </form>
  </main>
<?
}
?>