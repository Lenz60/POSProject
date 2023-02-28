<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Purchase Order</h1>
            <br>
            <h4>Insert data Purchase Order</h4>
            <form method='POST' action="/purchase">
                <?= csrf_field(); //*csrf secure 
                ?>
                <div class="form-group">
                    <label for="suppid">Supplier id</label>
                    <input type="text" class="form-control" id="suppid" name='suppid' placeholder="Check Supplier ID on Supplier Product Page">
                </div>
                <div class="form-group">
                    <label for="prodid">Product Id</label>
                    <input type="text" class="form-control" id="prodid" name="prodid" placeholder="Check Product ID on Product Page">
                    <small id="prodidhelp" class="form-text text-muted">Empty if want to add new product</small>
                </div>
                <div class="form-group">
                    <label for="newprodname">New Product Name</label>
                    <input type="text" class="form-control" id="newprodname" name="newprodname">
                    <small id="newprodnamehelp" class="form-text text-muted">Input new product name if you want to add new product</small>
                </div>
                <div class="form-group">
                    <label for="purprice">Purchased Price</label>
                    <input type="text" class="form-control" id="purprice" name="purprice" placeholder="Check Product ID on Product Page">
                </div>
                <div class="form-group">
                    <label for="qty">qty</label>
                    <input type="text" class="form-control" id="qty" name="qty">
                </div>
                <div class="form-group">
                    <label for="discount">discount</label>
                    <input type="text" class="form-control" id="discount" name="discount">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <? print_r('data'); ?>
        <div class="mx-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">supplier id</th>
                        <th scope="col">supplier name</th>
                        <th scope="col">product id</th>
                        <th scope="col">product name</th>
                        <th scope="col">qty</th>
                        <th scope="col">discount</th>
                        <th scope="col">dpp price</th>
                        <th scope="col">ppn price</th>
                        <th scope="col">total price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $row) { ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['name'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td><?= $row['address'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
</div>
<?= $this->endSection('content'); ?>