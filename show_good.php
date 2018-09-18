<?php
// start session
//session_start();

// connect to database
include_once 'neWDB.php';

// include objects
include_once "Shopping_Car/objects/product.php";
include_once "Shopping_Car/objects/product_image.php";

// class instances will be here

// get database connection
$database = new NeWDB();
$db = $database->getConnection();

// initialize objects
$product = new Product($db);
$product_image = new Product_image($db);

// to prevent undefined index notice
$action = isset($_GET['action']) ? $_GET['action'] : "";

// for pagination purposes
$page = isset($_GET['page']) ? $_GET['page'] : 1; // page is the current page, if there's nothing set, default is page 1
$records_per_page = 6; // set records or rows of data per page
$from_record_num = ($records_per_page * $page) - $records_per_page; // calculate for the query LIMIT clause

// set page title
$page_title="Products";

// page header html
include 'layout_header.php';

//通知列起頭================================================
//新增首頁通知列:商品已經"加入"於購物車
echo "<div class='col-md-12'>";
if($action=='added'){
    echo "<div class='alert alert-info'>";
    echo "Product was added to your cart!";
    echo "</div>";
}

//新增首頁通知列:商品已經"存在"於購物車
if($action=='exists'){
    echo "<div class='alert alert-info'>";
    echo "Product already exists in your cart!";
    echo "</div>";
}
echo "</div>";
//通知列結尾================================================

// read all products in the database
$stmt=$product->read($from_record_num, $records_per_page);

// count number of retrieved products
$num = $stmt->rowCount();

// if products retrieved were more than zero
if($num>0){
    // needed for paging
    $page_url="Index.php?";
    $total_rows=$product->count();
    // show products
    include_once "read_products_template.php";
}

// tell the user if there's no products in the database
else{
    echo "<div class='col-md-12'>";
    echo "<div class='alert alert-danger'>No products found.</div>";
    echo "</div>";
}
// contents will be here

// layout footer code

//include 'layout_footer.php';
?>
</div>
<!-- /row -->

</div>
<!-- /container -->
