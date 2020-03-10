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
              <a class="nav-link btn text-light" href="stats.php" id="stats">Stats</a>
            </li>
            <li class="nav-item">
              <a class="nav-link btn text-light" href="#" id="panel3">Settings</a>
            </li>
          </ul>
        </div>
        <div class="float-right">
          <ul class="nav float-right">
            <li class="nav-item dropdown">
              <a class="nav-link btn btn-md btn-info d-flex justify-content-around" data-toggle="dropdown"><ion-icon name="contact" class="icon-big text-dark"></ion-icon><p class="bigger-p nickname text-dark"><?php echo $_SESSION['logged']; ?></p></a>
              <div class="dropdown-menu">
                <a class="dropdown-item d-flex" href="profile.php"><ion-icon name="person" class="drop-icon"></ion-icon><span>Profile</span></a>
                <a class="dropdown-item d-flex" href="#"><ion-icon name="wallet" class="drop-icon"></ion-icon><span>Payments</span></a>
                <a class="dropdown-item d-flex" href="#"><ion-icon name="settings" class="drop-icon"></ion-icon><span>Settings</span></a>
                <a class="dropdown-item d-flex" href="logout.php"><ion-icon name="close-circle" class="drop-icon"></ion-icon><span>Log out</span></a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</nav>
<script>
function toggleDropdown (e) {
  const _d = $(e.target).closest('.dropdown'),
    _m = $('.dropdown-menu', _d);
  setTimeout(function(){
    const shouldOpen = e.type !== 'click' && _d.is(':hover');
    _m.toggleClass('show', shouldOpen);
    _d.toggleClass('show', shouldOpen);
    $('[data-toggle="dropdown"]', _d).attr('aria-expanded', shouldOpen);
  }, e.type === 'mouseleave' ? 300 : 0);
}

$('body')
  .on('mouseenter mouseleave','.dropdown',toggleDropdown)
  .on('click', '.dropdown-menu a', toggleDropdown);
</script>
