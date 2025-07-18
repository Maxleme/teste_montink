<nav class="navbar navbar-expand-lg bg-dark">
  <div class="container-fluid">    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link link-light active" href="{{ url('/') }}">Produtos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link link-light" href="{{ url('/pedidos') }}">Pedidos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link link-light" href="{{ url('/cupons') }}">Cupons</a>
        </li>
        <li class="nav-item">
            <a href="{{ route('carrinho.ver') }}" class="btn btn-secondary position-relative">
              <i class="bi bi-cart"></i>
              @if(count(session()->get('carrinho', [])) > 0)
                  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                  {{ array_sum(array_column(session()->get('carrinho', []), 'quantidade')) }}
                  </span>
              @endif
            </a>
        </li>
      </ul>      
    </div>
  </div>
</nav>
