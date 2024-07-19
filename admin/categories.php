<?php include "includes/header.php"; ?>

<?php
//Insert New Category
if (isset($_POST['add_category'])) {
    newCategory($con);
}

function newCategory($con)
{
    $cat_title = mysqli_real_escape_string($con, $_POST['cat_title']);

    $qry = "INSERT INTO categories(catTitle)VALUES";
    $qry .= "('{$cat_title}')";

    $new_category_qry = mysqli_query($con, $qry);
    if (!$new_category_qry) {
        die('Qry Failed' . mysqli_error($con));
    }

    echo "<script>
        alert('Category has been save successfully!');
        window.location.href = 'categories.php';
        </script>";
    exit();
}
?>
<?php
//Delete Category
if (isset($_GET['delete_c_Id'])) {
    deleteCategory($con);
}

function deleteCategory($con)
{
    $cat_id = $_GET['delete_c_Id'];

    $qry = "DELETE FROM categories WHERE ";
    $qry .= "catId = {$cat_id}";

    $delete_category_qry = mysqli_query($con, $qry);
    if (!$delete_category_qry) {
        die('Qry Failed' . mysqli_error($con));
    }

    echo "<script>
        alert('Category has been deleted successfully!');
        window.location.href = 'categories.php';
        </script>";
    exit();
}
?>
<?php
//Prepare Update Details
if (isset($_GET['c_Id'])) {
    $cat_id = $_GET['c_Id'];
    $qry = "SELECT * FROM categories WHERE catId = {$cat_id}";
    $get_category_qry = mysqli_query($con, $qry);
    $row = mysqli_fetch_assoc($get_category_qry);

    $cat_title = $row['catTitle'];
}

if (isset($_POST['update_category'])) {
    updateCategory($con);
}

if (isset($_POST['cancel_category'])) {
    echo "<script>
                window.location.href = 'categories.php';
                </script>";
}

function updateCategory($con)
{
    $cat_id = mysqli_real_escape_string($con, $_POST['cat_id']);
    $cat_title = mysqli_real_escape_string($con, $_POST['cat_title']);

    $qry = "UPDATE categories SET ";
    $qry .= "catTitle = '{$cat_title}' ";
    $qry .= "WHERE catId = $cat_id";

    $update_category_qry = mysqli_query($con, $qry);
    if (!$update_category_qry) {
        die('Qry Failed' . mysqli_error($con));
    }

    echo "<script>
        alert('Category has been updated successfully!');
        window.location.href = 'categories.php';
        </script>";
    exit();
}

?>


<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="page-header">
                CMS Admin
                <small><?php echo getUser(); ?></small>
            </h1>
            <h2 class="bg-info">Categories</h2>

            
                <div class="row">
                    <div class="col-lg-6">
                        <form action="" method="post" enctype="multipart/form-data">
                            <?php
                            if (isset($_GET['c_Id'])) {
                            ?>
                                <div class="form-group">
                                    <input value=<?php if (isset($cat_id)) {
                                                        echo $cat_id;
                                                    } ?> class="form-control" type="hidden" name="cat_id">
                                    <label for="cat_title">Category</label>
                                    <input type="text" class="form-control" value="<?php echo $cat_title ?>" name="cat_title">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="update_category" value="Update Category">
                                    <input class="btn btn-primary" type="submit" name="cancel_category" value="Cancel Category">
                                </div>

                            <?php } else { ?>

                                <div class="form-group">
                                    <label for="cat_title">Category</label>
                                    <input type="text" class="form-control" name="cat_title">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="add_category" value="Add Category">
                                </div>

                            <?php } ?>
                        </form>

                    </div>
                    <div class="col-lg-6">

                        <table class="table table-bordered table-hover">
                            <thread>
                                <tr>
                                    <th>ID</th>
                                    <th>Category</th>
                                    <th>In Active</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thread>
                            <tbody>
                                <?php
                                //ALl Posts
                                $qry = "SELECT * FROM categories where inActive = 0";
                                $select_all_categories = mysqli_query($con, $qry);
                                while ($row = mysqli_fetch_assoc($select_all_categories)) {
                                    $cat_id =  $row['catId'];
                                    $cat_title =  $row['catTitle'];
                                    $inActive =  $row['inActive'];
                                    echo "<tr>";
                                    echo  "<td>{$cat_id}</td>";
                                    echo  "<td>{$cat_title}</td>";
                                    echo  "<td>{$inActive}</td>";
                                    echo  "<td> <a href='categories.php?c_Id={$cat_id}'>Edit</a></td>";
                                    echo  "<td> <a href='categories.php?delete_c_Id={$cat_id}'>Delete</a></td>";
                                    echo "</tr>";
                                }

                                ?>
                    </div>
                </div>
                <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<?php include "includes/footer.php"; ?>