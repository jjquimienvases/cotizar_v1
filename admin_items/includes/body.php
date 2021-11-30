<?php include 'navbar.php'; ?>

<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#create_item" type="button" role="tab" aria-controls="home" aria-selected="true">Crear Item</button>
    </li>
    <li class="nav-item">
        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#edit_item" type="button" role="tab" aria-controls="profile" aria-selected="true">Editar Item</button>
    </li>
    <li class="nav-item">
        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#categorias" type="button" role="tab" aria-controls="profile" aria-selected="true">Crear y Editar Categorias</button>
    </li>
    <li class="nav-item">
        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#prima" type="button" role="tab" aria-controls="profile" aria-selected="true">Crear Materia Prima</button>
    </li>
</ul>

<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="create_item" role="tabpanel" aria-labelledby="home-tab">
        <?php include  "form_create_item.php"; ?>
    </div>
    <div class="tab-pane fade" id="edit_item" role="tabpanel" aria-labelledby="home-tab">
        <?php include  "form_edit_item.php"; ?>
    </div>
    <div class="tab-pane fade" id="categorias" role="tabpanel" aria-labelledby="home-tab">
        <?php include  "form_create_categoria.php"; ?>
    </div>

</div>