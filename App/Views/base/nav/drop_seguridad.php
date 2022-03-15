<!-- Droppdown que contiene los participantes y administradores -->
<li class="nav-item dropdown">
    <button class="btn btn-secondary dropdown-toggle" id="dropdown_seguridad" data-bs-toggle="dropdown"
        aria-expanded="false">
        <i class="fas fa-shield-alt"></i> Seguridad
    </button>
    <ul class="dropdown-menu bg-secondary" aria-labelledby="dropdown_seguridad">
        <li class="nav-item">
            <!-- Administradores-->
            <a class="nav-link" style="font-size: smaller;" href="<?= baseUrl("seguridad") ?>">
                <div class="d-flex justify-content-between">
                    Administradores 
                    <i class="fas fa-user-shield"></i>
                </div>
            </a>
        </li>

        <!-- Auditorias -->
        <li class="nav-item">
            <a class="nav-link" style="font-size: smaller;" href="<?= baseUrl("seguridad/auditorias") ?>">
                <div class="d-flex justify-content-between">
                    Auditorias <i class="fas fa-search"></i>
                </div>
            </a>
        </li>
    </ul>
</li>