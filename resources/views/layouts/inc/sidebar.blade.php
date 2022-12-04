<div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
    <div class="logo"><a href="{{ url('/') }}" class="simple-text logo-normal">
            StoreLM
        </a></div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('dashboard') }}">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item {{ Request::is('categorias') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('categorias') }}">
                    <i class="material-icons">person</i>
                    <p>Categorias</p>
                </a>
            </li>
            <li class="nav-item {{ Request::is('add-categoria') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('add-categoria') }}">
                    <i class="material-icons">person</i>
                    <p>Adicionar Categoria</p>
                </a>
            </li>
            <li class="nav-item {{ Request::is('produtos') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('produtos') }}">
                    <i class="material-icons">person</i>
                    <p>Produtos</p>
                </a>
            </li>
            <li class="nav-item {{ Request::is('add-produto') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('add-produto') }}">
                    <i class="material-icons">person</i>
                    <p>Adicionar Produtos</p>
                </a>
            </li>
            <li class="nav-item  {{ Request::is('pedidos') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('pedidos') }}">
                    <i class="material-icons">content_paste</i>
                    <p>Pedidos</p>
                </a>
            </li>
            <li class="nav-item  {{ Request::is('users') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('users') }}">
                    <i class="material-icons">persons</i>
                    <p>Usuários</p>
                </a>
            </li>
        </ul>
    </div>
</div>
