<?php
include('includes/Header.php');
include('includes/Helper.php');
$header = new Header('', 'Generate Report');
$header->initHeader();
?>
<?php include('includes/navbar.php') ?>
<div class="container">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Generate Report</h1>
    </div>

    <form class="col-12 row g-2">
        <!--
        <div class="row">
            <label for="inputCity" class="col form-label">Product Name</label>
            <div class="col">
                <input type="text" class="form-control" id="inputCity">
            </div>

        </div>
        <div class="row">
            <label for="exampleDataList" class="col col-form-label">Email</label>
            <div class="col-sm-10">

                <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="">
                <datalist id="datalistOptions">
                    <option value="Tops">
                    <option value="Jeans">
                    <option value="Dresses">
                </datalist>
            </div>
        </div>
        <div class=" row">
            <label for="exampleDataList" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">

                <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="">
                <datalist id="datalistOptions">
                    <option value="Tops">
                    <option value="Jeans">
                    <option value="Dresses">
                </datalist>
            </div>
        </div>

        -->
        <div class="col-12 row g-3">
            <div class="col-4">

                <label for="inputZip" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="inputZip" >
            </div>
            <div class="col">

                <label for="exampleDataList" class="form-label">Category</label>

                <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="">
                <datalist id="datalistOptions">
                    <option value="Dresses">
                    <option value="Jeans">
                    <option value="Tops">
                </datalist>
            </div>

            <div class="col">

                <label for="exampleDataList" class="form-label">Status</label>

                <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Status">
                <datalist id="datalistOptions">
                    <option value="In Stock">
                    <option value="Out of Stock">
                    <option value="Loan">
                </datalist>
            </div>
            <div class="col">

                <label for="inputZip" class="form-label">Staff ID</label>
                <input type="text" class="form-control" id="inputZip" >
            </div>
            <div class="col">
                <label for="inputZip" class="form-label">Retailer ID</label>
                <input type="text" class="form-control" id="inputZip" >
            </div>
        </div>


        <div class="col-12 mt-4" >
            <button type="submit" class="btn btn-primary">Search</button>
            <button type="submit" class="btn" style="border-color: black">Reset</button>
        </div>
    </form>

    <br>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Product Name</th>
            <th>Category </th>
            <th>Quantity</th>
            <th>Status</th>
            <th>Staff ID</th>
            <th>Retailer ID</th>
            <th>Loan Date</th>
            <th>Return Date</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                <a class="nav-item" href="#">Levi's Jeans (Black)</a>
            </td>
            <td>Jeans</td>
            <td>0</td>
            <td>Out of Stock</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Pink Sweatshirt</td>
            <td>Tops</td>
            <td>10</td>
            <td>Loan</td>
            <td>1912121</td>
            <td>ST888</td>
            <td>1/12/2020</td>
            <td>30/12/2020</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>
</div>


<?php
include('includes/footer.php');
?>

