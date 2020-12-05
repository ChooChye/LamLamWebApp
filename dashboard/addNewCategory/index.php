<?php
include_once('../../includes/Header.php');
$header = new Header('../../', 'Add new Category');
$header->initHeader();

?>

<!-- Page Wrapper -->
<div id="wrapper">
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">
            <?php include('../../includes/navbar.php') ?>

            <!-- Begin Page Content -->
            <div class="container">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Dashboard - Add new category</h1>
                </div>

                <!-- Content Row -->

                <div class="row">
                    <div class="col-xl-6 col-lg-5">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <form>
                                    <div class="form-group mb-3">
                                        <input type="text" class="form-control" placeholder="Category Name"/>
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="submit" class="btn btn-success" value="Add"/>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


            </div> <!-- END Page Content -->
        </div>
    </div>
</div>
