<!-- Dropdown Feria que contiene productos y puesto -->
<li class="nav-item dropdown">
    <button class="btn btn-secondary" type="button">
        <i class="fas fa-store-alt"></i> Feria
    </button>

    <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown"
        aria-expanded="false">
        <span class="visually-hidden">Toggle Dropdown</span>
    </button>

    <ul class="dropdown-menu bg-dark">
        <li class="nav-item">
            <a class="nav-link" style="font-size: smaller;" href="<?= baseUrl("mercado/catalogo") ?>">
                <div class="d-flex justify-content-between">
                    Catalogo
                    <i class="fas fa-shopping-cart"></i>
                </div>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" style="font-size: smaller;" href="<?= baseUrl("mercado/puesto") ?>">
                <div class="d-flex justify-content-between">
                    Puesto
                    <i class="fas fa-people-carry"></i>
                </div>
            </a>
        </li>

        <!-- Participantes -->
        <li class="nav-item">
            <a class="nav-link" style="font-size: smaller;" href="<?= baseUrl("seguridad/participantes") ?>">
                <div class="d-flex justify-content-between">
                    Participantes <i class="fas fa-user-friends"></i>
                </div>
            </a>
        </li>
    </ul>
</li>