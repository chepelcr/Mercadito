<!-- Modulos -->
<?php foreach ($modulos as $modulo) :
    $nombre_modulo = $modulo->nombre_modulo;
    $icono = $modulo->icono;
    $submodulos = $modulo->submodulos;

    if (count((array) $submodulos) > 0) :
?>

<li class="nav-item dropdown pr-1">
    <button class="btn btn-secondary nav-modulo nav-<?= $nombre_modulo ?>" data-toggle="tooltip"
        title="<?= ucwords(str_replace('_', ' ', $nombre_modulo)) ?>"
        onclick="cargar_inicio_modulo('<?php echo $modulo->nombre_modulo ?>')" type="button">
        <i class="fa-solid <?= $icono ?> nav-icon"></i>
        <span class="nav-text"><?= ucwords(str_replace('_', ' ', $nombre_modulo)) ?></span>
    </button>

    <button type="button"
        class="btn btn-danger nav-menu dropdown-toggle dropdown-toggle-split nav-menu-<?= $nombre_modulo ?>"
        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="sr-only">Toggle Dropdown</span>
    </button>

    <div class="dropdown-menu drp-nav dropdown-menu-left bg-transparent border-0 shadow-none"
        aria-labelledby="nav-<?= $nombre_modulo ?>">
        <?php foreach ($submodulos as $submodulo) :
                    $nombre_submodulo = $submodulo->nombre_submodulo;
                    $icono = $submodulo->icono;
                    $url = $submodulo->url;

                    if (validar_permiso($nombre_modulo, $nombre_submodulo, 'consultar')) :
                ?>
        <div class="p-1">
            <button data-toggle="tooltip" title="<?= ucwords(str_replace('_', ' ', $nombre_submodulo)) ?>"
                class="w-100 btn btn-dark nav-button btn_<?= $nombre_modulo . '_' . $nombre_submodulo ?>" type="button"
                onclick="cargar_listado('<?= $nombre_modulo ?>', '<?= $nombre_submodulo ?>', '<?= baseUrl($url) ?>')">
                <div class="d-flex justify-content-between">
                <?= ucwords(str_replace('_', ' ', $nombre_submodulo)) ?> <i class="fa-solid <?= $icono ?>"></i>
                </div>
            </button>
        </div>
        <?php endif;
                endforeach; ?>
    </div>
</li>
<?php endif;
endforeach; ?>