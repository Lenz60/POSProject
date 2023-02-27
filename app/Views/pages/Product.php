<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Product</h1>
            <br>
            <h4>Data of Product</h4>
        </div>
        <? print_r('data'); ?>
        <div class="mx-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Supplier_id</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Price/pcs</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $row) { ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['supplier_id'] ?></td>
                            <td><?= $row['name'] ?></td>
                            <td><?= $row['price'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
</div>
<?= $this->endSection('content'); ?>