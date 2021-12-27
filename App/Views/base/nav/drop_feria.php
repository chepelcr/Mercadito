<!-- Dropdown Feria que contiene productos y puesto -->
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="dropdown_feria" role="button" data-bs-toggle="dropdown"
        aria-expanded="false">
        <i class="fas fa-store-alt"></i> Feria
    </a>

    <ul class="dropdown-menu bg-dark" aria-labelledby="dropdown_feria">
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
    </ul>
</li>