const navbar = document.createElement("template");
navbar.innerHTML = `
<nav class="navbar navbar-expand-lg navbar-dark header">
<div class="container-fluid">
  <a class="navbar-brand h1 " href="#">
    <img src="../assets/logo.png" width="70" height="70" class="d-inline-block align-top " alt="logo">
    <h3 class="d-inline-block align-top mt-3" style="color:#101D6B">Sri Lanka Police</h3>
  </a>
  <!--<a class="navbar-brand" href="#">
      <img src="../assets/logo.png"  width="70" height="70" class=" align-top" alt="Logo">
      Sri Lanka Police
  </a>
  <a class="nav-link h6" href="#" style="color:#101D6B ">Register</a>-->

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link h6" href="#" style="color:#101D6B">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link h6" href="#" style="color:#101D6B">
          <bold>About</bold>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link h6" href="#" style="color:#101D6B ">Register</a>
      </li>
      <li class="nav-item">
        <a class="nav-link h6" href="#" style="color:#101D6B">Settings</a>
      </li>
    </ul>
  </div>
</div>
</nav>
`;

document.body.appendChild(navbar.content);