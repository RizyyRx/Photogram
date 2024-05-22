<section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <?
          /**
           * If authorize() is executed correctly, the initiateSession() in WebAPI.class will assign an User class object to Session::$user
           * Now, using getUsername(), the username of the specific user of the session will be fetched
           */
        ?>
        <h1 class="fw-light">What are you upto, <?=Session::getUser()->getUsername()?>?</h1>
        <p class="lead text-body-secondary">Share a photo that talks about it.</p>
        <p>
          <a href="#" class="btn btn-primary my-2">Upload</a>
          <a href="#" class="btn btn-secondary my-2">Clear</a>
        </p>
      </div>
    </div>
  </section>