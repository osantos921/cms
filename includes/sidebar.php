<div class="col-md-4">

<!-- Blog Search Well -->
<div class="well">
    <h4>Blog Search</h4>
    <div class="input-group">
        <input type="text" class="form-control">
        <span class="input-group-btn">
            <button class="btn btn-default" type="button">
                <span class="glyphicon glyphicon-search"></span>
            </button>
        </span>
    </div>
    <!-- /.input-group -->
</div>

<!-- Blog Categories Well -->
<div class="well">
    <h4>Blog Categories</h4>
    <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                    <?php                                      
                    $select_all_category_sidebar = GetCategories($con);

                    while ($row = mysqli_fetch_assoc($select_all_category_sidebar)) {
                        $cat_id =  $row['catId'];
                        $cat_title =  $row['catTitle'];
                        echo  "<li><a href='#'>{$cat_title}</a></li>";
                    }
                    ?>
                </ul>
            </div>

        </div>
    <!-- /.row -->
</div>

<!-- Side Widget Well -->
<div class="well">
    <h4>Side Widget Well</h4>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
</div>

</div>