<nav class="container-fluid fixed-top shadow">
  <div class="row bg-dark text-white">
    <div class="col-12">

<!-- COLLAPSE MAIN NAVBAR -->
      <div class="navbar navbar-expand-md bg-dark text-white">
        <button class="navbar-toggler custom-toggler" type="button" data-toggle="collapse" data-target="#mainNavbar">
          <span class="navbar-toggler-icon text-white custom-toggler"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link btn text-light" href="index.php" id="home">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link btn text-light" href="#" id="panel1">panel1</a>
            </li>
            <li class="nav-item">
              <a class="nav-link btn text-light" href="#" id="panel2">panel2</a>
            </li>
            <li class="nav-item">
              <a class="nav-link btn text-light" href="#" id="panel3">panel3</a>
            </li>
          </ul>
        </div>
        <div class="float-right">
          <ul class="nav float-right">
            <li class="nav-item">
              <a class="nav-link btn btn-md btn-info" href="#"><ion-icon name="contact" class="icon-big text-dark"></ion-icon><?$_SESSION['logged']?></a>
            </li>
            <li class="nav-item">
              <a class="" href="#"><ion-icon name="settings" class="icon-big text-dark"></ion-icon></a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</nav>
