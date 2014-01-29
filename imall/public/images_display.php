<?php
$request = new \Phalcon\Http\Request();

// Check whether the request was made with method POST
if ($request->isPost() == true) {
    // Check whether the request was made with Ajax
    if ($request->isAjax() == true) {
	$image = $_POST['id'];
?>
<div class="loadimage">
	<img src="/ci/uploads/posts/<?php echo $image; ?>" alt="" title="" />
</div>
<?php } 
}
?>
