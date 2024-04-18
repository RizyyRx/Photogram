<?
$signup = false;
print_r($_POST);
print("it stops here right?");
if (!empty($_POST['username']) and !empty($_POST['email_addr']) and !empty($_POST['pass']) and !empty($_POST['phone'])) {
  print("does it comes here?");
  $username = $_POST['username'];
  $email = $_POST['email_addr'];
  $password = $_POST['pass'];
  $phone = $_POST['phone'];
  print("but is it here?");
  $error = User::signup($username, $email, $password, $phone);
  print("also here?");
  $signup = true;
  var_dump($error);
  print("error should be here");
}
?>
<?
if ($signup) {
  if (!$error) {
    var_dump($error); ?>
    <main class="container">
      <div class="bg-body-tertiary p-5 rounded mt-3">
        <h1>Signup success</h1>
        <p class="lead">Now you can login from <a href="/app/login.php">here</a></p>
        <a class="btn btn-lg btn-primary" href="/docs/5.3/components/navbar/" role="button">View navbar docs »</a>
      </div>
    </main>
  <?
  } else {
    var_dump($error); ?>
    <main class="container">
      <div class="bg-body-tertiary p-5 rounded mt-3">
        <h1>Signup failed</h1>
        <p class="lead">Something went wrong, <?= $error ?></p>
        <a class="btn btn-lg btn-primary" href="/docs/5.3/components/navbar/" role="button">View navbar docs »</a>
      </div>
    </main>
  <?
  }
} else {
  ?>
  <main class="form-signup w-100 m-auto">
    <form method="post" action="signup.php">
      <img class="ms-1 mb-3" src="/app/maeve 3.png" alt="image here" height="150">
      <h1 class="h3 mb-3 fw-normal">Sign up here</h1>
      <div class="form-floating">
        <input name="username" type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
        <label for="floatingInput">Username</label>
      </div>
      <div class="form-floating">
        <input name="email_addr" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
        <label for="floatingInput">Email address</label>
      </div>
      <div class="form-floating">
        <input name="pass" type="password" class="form-control" id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">Password</label>
      </div>
      <div class="form-floating">
        <input name="phone" type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
        <label for="floatingInput">Phone</label>
      </div>

      <div class="form-check text-start my-3">
        <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
        <label class="form-check-label" for="flexCheckDefault">
          Remember me
        </label>
      </div>
      <button class="btn btn-primary w-100 py-2 hvr-buzz-out" type="submit">Sign up</button>
    </form>
  </main>
<?
}
?>