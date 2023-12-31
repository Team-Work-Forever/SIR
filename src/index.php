<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Os Mestres da Culinária</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
  <link rel="stylesheet" href="styles.css" />
</head>

<body>
  <nav class="d-flex w-100 position-fixed justify-content-between navbar navbar-expand-lg px-4">
    <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse"
      data-bs-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false"
      aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <a class="navbar-brand" href="#">
      <img src="./assets/icon.svg" alt="" />
    </a>

    <div class="collapse navbar-collapse" id="navbarToggler">
      <ul class="navbar-nav m-1">
        <li class="nav-item">
          <a class="nav-link active" href="#home">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#objetives">Objetivo</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#features">Funcionalidades</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#about-us">Sobre nós</a>
        </li>
      </ul>
      <ul class="navbar-nav d-flex justify-content-end bg-back flex-grow-1">
        <li class="d-flex gap-3 justify-content-between">
          <button class="btn green btn-block" type="submit" data-bs-toggle="modal" data-bs-target="#register">
            Registar
          </button>
          <button class="btn blue btn-block" type="submit" data-bs-toggle="modal" data-bs-target="#login">
            Iniciar Sessão
          </button>
        </li>
      </ul>
    </div>
  </nav>

  <section id="home" class="home container-fluid">
    <div class="row d-flex justify-content-center align-items-md-end h-100">
      <div class="col-md-5"></div>
      <div class="row col-12 col-md-7">
        <img src="./assets/landpage-icon.svg" alt="" />
        <h2 class="text-light text-center">
          O seu site de gestão de receitas e de inspiração!
        </h2>
      </div>
      <div class="row d-flex justify-content-center align-items-end pb-4">
        <a href="#objetives" class="goDown">
          <i class="bi bi-arrow-down-circle"></i>
        </a>
      </div>
    </div>
  </section>

  <section id="objetives" class="objetives container-fluid">
    <div class="row d-flex justify-content-center h-100 align-items-end">
      <div class="row text-bottom-page">
        <h2 class="text-light text-center">
          <p>
            Um site que permite criar as suas próprias receitas, procurar e
            seguir os passos para obter um prato delicioso!
          </p>
          <p>
            O nosso objetivo é facilitar o acesso e fornecer uma sequência de
            passos para refazer os seus pratos favoritos.
          </p>
        </h2>
      </div>
      <div class="row d-flex justify-content-center align-items-end pb-4">
        <a href="#features" class="goDown">
          <i class="bi bi-arrow-down-circle"></i>
        </a>
      </div>
    </div>
  </section>

  <section id="features" class="container-fluid px-4">
    <div class="d-flex flex-column h-100">
      <div class="row h-100">
        <div class="col-md-6 col-12 d-flex flex-column d-flex justify-content-center gap-4">
          <div class="card-feature d-flex align-items-center justify-content-center">
            <div class="row g-0">
              <div class="col-4">
                <img src="./assets/create_recipe.svg" class="img-fluid rounded-start" alt="" />
              </div>
              <div class="col-8 d-flex align-items-center justify-content-center">
                <div class="card-body">
                  <h5 class="card-title">Criar Receitas</h5>
                  <p class="card-text">
                    Crie as suas próprias receitas, com os seu próprios
                    ingredientes e passos
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="card-feature d-flex align-items-center justify-content-center">
            <div class=" row g-0">
              <div class="col-4">
                <img src="./assets/see_recipe.svg" class="img-fluid rounded-start" alt="" />
              </div>
              <div class="col-8 d-flex align-items-center justify-content-center">
                <div class="card-body">
                  <h5 class="card-title">Visualizar Receitas</h5>
                  <p class="card-text">
                    Volte a fazer as suas receitas ou experimente novas
                    receitas
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="card-feature d-flex align-items-center justify-content-center">
            <div class="row g-0">
              <div class="col-4">
                <img src="./assets/share_recipe.svg" class="img-fluid rounded-start" alt="" />
              </div>
              <div class="col-8 d-flex align-items-center justify-content-center">
                <div class="card-body">
                  <h5 class="card-title">Partilhar Receitas</h5>
                  <p class="card-text">
                    Partilhe as suas receitas favoritas com os seus amigos
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-6 d-flex">
          <div class="d-none d-md-flex">
            <img src="./assets/image_features.svg" class="scaled-image img-fluid" alt="" />
          </div>
        </div>
      </div>
      <div class="row d-flex justify-content-center align-items-end pb-4 ">
        <a href="#about-us" class="goDown alternative">
          <i class="bi bi-arrow-down-circle"></i>
        </a>
      </div>
    </div>
  </section>

  <section id="about-us" class="about-us container-fluid bg-black">
    <div class="row h-100">
      <div class="d-flex flex-column justify-content-end">
        <div id="carouselExampleIndicators" class="carousel slide d-md-none" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="2000">
              <div class="d-flex align-items-center justify-content-center">
                <div class="col-12 col-md-4 card person-card text-center position-relative">
                  <img src="./assets/cooking_hat.svg" alt="" class="cooking-hat" />
                  <div class="col d-flex justify-content-center">
                    <img src="./assets/diogo.png" class="person-image" alt="" />
                  </div>
                  <div class="card-body">
                    <h2 class="card-title text-center text-truncate">
                      Diogo Assunção
                    </h2>
                  </div>
                  <div>
                    <a href="https://www.instagram.com" target="_blank"><i class="icon bi bi-instagram"></i></a>
                    <a href="https://www.facebook.com/diogo.assuncao.1011" target="_blank"><i
                        class="icon bi bi-facebook"></i></a>
                    <a href="https://www.linkedin.com/in/diogo-assunc%C3%A3o-0a1ab921b/" target="_blank"><i
                        class="icon bi bi-linkedin"></i></a>
                    <a href="https://github.com/DiogoCC7" target="_blank"><i class="icon bi bi-github"></i></a>
                  </div>
                </div>
              </div>
            </div>
            <div class="carousel-item" data-bs-interval="2000">
              <div class="d-flex align-items-center justify-content-center">
                <div class="col-12 col-md-4 card person-card text-center position-relative">
                  <img src="./assets/wooden_spoon.svg" alt="" class="wooden-spoon" />
                  <div class="col d-flex justify-content-center">
                    <img src="./assets/david.png" class="person-image" alt="" />
                  </div>
                  <div class="card-body">
                    <h2 class="card-title text-center">David Sousa Braga</h2>
                  </div>
                  <div>
                    <a href="https://www.instagram.com" target="_blank"><i class="icon bi bi-instagram"></i></a>
                    <a href="https://www.facebook.com/david.braga.902266/" target="_blank"><i
                        class="icon bi bi-facebook"></i></a>
                    <a href="https://www.linkedin.com/in/david-braga-9093252a0/" target="_blank"><i
                        class="icon bi bi-linkedin"></i></a>
                    <a href="https://github.com/David-Ogrande" target="_blank"><i class="icon bi bi-github"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
        <div class="col-md-12 d-none d-md-flex flex-grow-1">
          <div class="col-12 team d-flex justify-content-center flex-wrap">
            <div class="col-12 col-md-4 card person-card text-center position-relative d-none d-sm-block">
              <img src="./assets/cooking_hat.svg" alt="" class="cooking-hat" />
              <div class="col d-flex justify-content-center">
                <img src="./assets/diogo.png" class="person-image" alt="" />
              </div>
              <div class="card-body">
                <h2 class="card-title text-center">Diogo Machado Assunção</h2>
              </div>
              <div>
                <a href="https://www.instagram.com" target="_blank"><i class="icon bi bi-instagram"></i></a>
                <a href="https://www.facebook.com/diogo.assuncao.1011" target="_blank"><i
                    class="icon bi bi-facebook"></i></a>
                <a href="https://www.linkedin.com/in/diogo-assunc%C3%A3o-0a1ab921b/" target="_blank"><i
                    class="icon bi bi-linkedin"></i></a>
                <a href="https://github.com/DiogoCC7" target="_blank"><i class="icon bi bi-github"></i></a>
              </div>
            </div>
            <div class="col-12 col-md-4 card person-card text-center position-relative d-none d-sm-block">
              <img src="./assets/wooden_spoon.svg" alt="" class="wooden-spoon" />
              <div class="col d-flex justify-content-center">
                <img src="./assets/david.png" class="person-image" alt="" />
              </div>
              <div class="card-body">
                <h2 class="card-title text-center">David Sousa Braga</h2>
              </div>
              <div>
                <a href="https://www.instagram.com" target="_blank"><i class="icon bi bi-instagram"></i></a>
                <a href="https://www.facebook.com/david.braga.902266/" target="_blank"><i
                    class="icon bi bi-facebook"></i></a>
                <a href="https://www.linkedin.com/in/david-braga-9093252a0/" target="_blank"><i
                    class="icon bi bi-linkedin"></i></a>
                <a href="https://github.com/David-Ogrande" target="_blank"><i class="icon bi bi-github"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="h-auto d-flex flex-row justify-content-center align-items-start">
        <div class="card">
          <div class="card-body text-center p-4">
            <h4>
              Somos alunos do Curso de Engenharia Informática do IPVC ESTG
            </h4>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Register Modal -->
  <div class="modal" id="register" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header justify-content-center">
          <h2 class="modal-title">Registar Conta</h2>
        </div>
        <div class="modal-body d-flex gap-3 flex-column">
          <div class="model-section col">
            <div class="row my-2">
              <div class="col">
                <!-- First Name -->
                <input id="first_name" type="text" class="form-control" placeholder="Nome Próprio" required />
              </div>
              <div class="col">
                <!-- Last Name -->
                <input id="last_name" type="text" class="form-control" placeholder="Apelido" required />
              </div>
            </div>
            <div class="col my-2">
              <!-- E-mail -->
              <input id="e_mail" type="email" class="form-control" placeholder="E-mail" required />
            </div>
            <div class="col my-2">
              <!-- Password -->
              <input id="password" type="password" class="form-control" placeholder="Password" required />
            </div>
          </div>
          <div class="model-section col">
            <!-- Birth Date -->
            <label for="birthDate">Data de Nascimento</label>
            <div class="row">
              <!-- Day -->
              <select id="day" class="col mx-2 form-select" aria-label="Dia">
                <option selected>Dia</option>
              </select>

              <!-- Month -->
              <select id="month" class="col mx-2 form-select" aria-label="Mês">
                <option selected>Mês</option>
              </select>

              <!-- Year -->
              <select id="year" class="col mx-2 form-select" aria-label="Ano">
                <option selected>Ano</option>
              </select>
            </div>
          </div>
          <div class="model-section col">
            <!-- Gender -->
            <label for="gender">Género</label>
            <div class="col mx-2">
              <!-- Masculino -->
              <div class="col form-check">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1"
                  value="option1" />
                <label class="form-check-label" for="inlineRadio1">Masculino</label>
              </div>
              <!-- Feminino -->
              <div class="col form-check">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2"
                  value="option2" />
                <label class="form-check-label" for="inlineRadio2">Feminino</label>
              </div>
              <!-- Outro -->
              <div class="col form-check">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3"
                  value="option3" />
                <label class="form-check-label" for="inlineRadio3">Outro</label>
              </div>
              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio4" value="option4"
                checked />
              <label class="form-check-label" for="inlineRadio4">Prefiro Não Divulgar</label>
            </div>
          </div>
        </div>
        <div class="modal-footer row d-flex justify-content-center mt-5">
          <button type="button" class="btn green" data-bs-dismiss="modal">
            Cancelar
          </button>
          <button type="button" class="btn blue">Registar Conta</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Login Modal -->
  <div class="modal" id="login" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header justify-content-center">
          <h2 class="modal-title">Iniciar Sessão</h2>
        </div>
        <div class="modal-body">
          <div class="col my-2">
            <!-- E-mail -->
            <input id="e_mail" type="email" class="form-control" placeholder="E-mail" required />
          </div>
          <div class="col my-2">
            <!-- Password -->
            <input id="password" type="password" class="form-control" placeholder="Password" required />
          </div>
          <div class="row mx-2">
            <!-- Forgot Password -->
            <a href="#" class="col forgot-password-link">Esqueceu-se da password?</a>
            <!-- Remember Me -->
            <div class="col form-check">
              <input class="form-check-input" type="checkbox" value="" id="remember" />
              <label class="form-check-label" for="remember">
                Lembrar-se de mim
              </label>
            </div>
          </div>
        </div>
        <div class="modal-footer row d-flex justify-content-center mt-5">
          <button type="button" class="btn green" data-bs-dismiss="modal">
            Cancelar
          </button>
          <button type="button" class="btn blue">Iniciar Sessão</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
    crossorigin="anonymous"></script>
  <script src="index.js"></script>
</body>

</html>