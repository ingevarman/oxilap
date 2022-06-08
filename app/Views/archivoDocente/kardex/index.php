<?php foreach ($kardex as $row) : ?>
    <div class="col-12 col-md-6 col-lg-12 mt-3">
        <div class="card">

            <div class="card-body table-responsive p-0">

                <div class="card border-bottom-0">
                    <div class="card-content border-bottom border-primary border-w-5">
                        <div class="card-body p-4">
                            <div class="d-flex">
                                <div class="circle-50 outline-badge-primary"> <span class="cf card-liner-icon fas <?= $row['icono'] ?> mt-2"></span></div>
                                <div class="media-body align-self-center pl-3">
                                    <span class="mb-0 h3 font-w-600"><?= $row['titulo'] ?></span><br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if (empty($row['data'])) : ?>
                    <div class="alert alert-warning" role="alert">
                        <b>No tiene <?= $row['titulo'] ?></b>, Registrado en el Sistema.
                    </div>
                <?php else : ?>
                    <table class="table  mb-0">
                        <thead>
                            <tr>
                                <?php foreach ($row['data'][0] as $encabezado => $valor) : ?>
                                    <th><?= $encabezado ?></th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($row['data'] as $rowKardex) : ?>
                                <tr class="ng-scope">
                                    <?php foreach ($rowKardex as $valor) : ?>
                                        <td><?= $valor ?></td>
                                    <?php endforeach; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>