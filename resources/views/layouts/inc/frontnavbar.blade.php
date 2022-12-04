<nav class="navbar navbar-expand-lg sticky-top navbar-light shadow bg-white">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">StoreLM</a>
        <div class="search-bar">
            <form action="{{ url('pesquisarproduto') }}" method="POST">
                @csrf
                <div class="input-group">
                    <input type="search" class="form-control" id="pesquisar_produto" name="produto_name" required
                        placeholder="Pesquisar na StoreLM" aria-describedby="basic-addon1">
                    <button type="submit" class="input-group-text">
                        &#128269;
                    </button>
                </div>
            </form>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('categoria') }}">Categoria</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('carrinho') }}">Carrinho <span
                            class="badge badge-pill bg-primary carrinho-count">0</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('lista-desejos') }}">Lista de Desejos <span
                            class="badge badge-pill bg-success listadesejos-count">0</span></a>
                </li>
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Cadastrar') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ url('meus-pedidos') }}">
                                    Meus Pedidos
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ url('dashboard') }}">
                                    Área do Administrador
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();  document.getElementById('logout-form').submit();">
                                    {{ __('Sair') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="post" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
