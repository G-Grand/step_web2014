<?php
	function __autoload($className) {
	    if(file_exists("../sourse/core/".$className.".class.php"))
	    {
	        include_once "..//sourse/core/".$className.".class.php";
	    }else {
	        die("MEGA FATAL!!!!!");
	    }
	} 	

	session_start();
	if(empty($_SESSION['userInfo'])) {
        header("Location: login.php");
    }

    $user = unserialize($_SESSION['userInfo']);
    $login = $user->getName();


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Adminka =)</title>
	<link type="text/css" rel="stylesheet" href="../css/bootstrap.css">
    <link type="text/css" rel="stylesheet" href="../css/bootstrap-datetimepicker.css">
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/bootstrap.js"></script>
    <script type="text/javascript" src="../js/moment-with-langs.js"></script>
    <script type="text/javascript" src="../js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap-datetimepicker.ru.js"></script>
    <script type="text/javascript" src="../js/admin.js"></script>
    <style type="text/css">
    	.no_width_resize {
    		resize:vertical;
    	}
    </style>
    <script type="text/javascript">
      window.onload = function() {

        getProducts("all", productsList);

        moreProductsBtn.addEventListener("click", function(){
            ProductsListObject.showed = showProducts(productsList, 5, ProductsListObject);
            if(ProductsListObject.showed == ProductsListObject.list.length)
                moreProductsBtn.style.display = 'none';
        });

        document.getElementById("addProductButton").addEventListener("click", addNewProduct);
        var btn = document.getElementById("addProductButton");
        function addNewProduct() {
          var newProduct = {};
          var xmlhttp = new XMLHttpRequest();

          var formElements = document.forms.addProductFormModal.elements;
          for (var i=0; i<formElements.length; ++i){
            if(formElements[i].getAttribute("class").indexOf("form-control") != -1)
              newProduct[formElements[i].getAttribute("name")] = formElements[i].value;
          }

          xmlhttp.open("POST", "addNewProductAJAX.php", true);
          xmlhttp.setRequestHeader('Content-Type', 'application/json');
          xmlhttp.onload = function() {
            var resp = JSON.parse(xmlhttp.responseText);
            alert(resp['response']);
          };
          xmlhttp.send(JSON.stringify(newProduct));
          btn.parentNode.childNodes[1].click();
        }

          $("#productsList a").on("click", function() {
              console.log("aaaaaaaaaaaaaaaaaaaAAAAAAAAAAAAAAAAAAAAAAAA");
          });

      };
    </script>
</head>
<body>

<!-- Modal productInfo -->
<div class="modal fade" id="productInfo" tabindex="-1" role="dialog" aria-labelledby="addProductLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="productName"></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="productFormInfoModal" enctype="multipart/form-data" method="POST" action="changeProductInfo.php">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">#id</label>
                        <div class="col-sm-10">
                            <p id="productInfoId" class="form-control-static"></p>
                            <input id="productInfoIdHID" type="hidden" name="productId" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10">
                            <input name="productName" id="productInfoName" type="text" class="form-control" placeholder="Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Price</label>
                        <div class="col-sm-10">
                            <input name="productPrice" id="productInfoPrice" type="text" class="form-control" placeholder="Price">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <input name="productIMG" id="productInfoImg" type="file" >
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button form="productFormInfoModal" type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>



<!-- Modal addProduct -->
<div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="addProductLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="addProductLabel">Новый товар</h4>
            </div>
            <div class="modal-body">
                <form id="addProductFormModal" method="POST">
                    <div class="form-group text-center">
                        <label>Наименвание товара</label>
                        <input name="productName" type="text" class="form-control" placeholder="Product Name">
                    </div>
                    <div class="row">
	                    <div class="form-group col-md-6">
	                        <label>Категория</label>
	                        <input name="productCategory" type="text" class="form-control" placeholder="Category">
	                    </div>
	                    <div class="form-group col-md-4 pull-right">
	                        <label>Цена</label>
	                        <input name="productPrice" type="text" class="form-control" placeholder="Price">
	                    </div>
	                </div>
                    <div class="form-group">
                        <label>Описание товара</label>
                        <textarea name="productDescription" class="form-control no_width_resize" rows="5"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="addProductButton" form="addProductFormModal" type="button" class="btn btn-primary">Add</button>
            </div>
        </div>
    </div>
</div>

	<!-- navigation bar -->
	<div class="navbar navbar-inverse navbar-fixed-top">
	    <div class="container">
	        <div class="navbar-header">
	            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	            </button>
	            <a href="#" class="navbar-brand">CMS_project</a>
	        </div>
	        <div class="navbar-collapse collapse">
	            <ul class="nav navbar-nav">
	            </ul>
	            <ul class='nav navbar-nav navbar-right'>
	            	<li><a>Привет, <?=$login?>!</a></li>
        			<li>
        				<form class='navbar-form' action='../autorizetion.php' method='POST'>
            				<button name='exit' type='submit' class='btn btn-warning' value='ex'>Выйти</button>
        				</form>
        			</li>
        		</ul>
	        </div>
	    </div>
	</div>

	<div class="container" style="margin-top: 100px;">
		<div class="panel panel-default">
			<div class="panel-body">
			    <div class="tabbable tabs-left">
    				<ul class="nav nav-tabs">
      					<li><a href="#a" data-toggle="tab">One</a></li>
      					<li><a href="#b" data-toggle="tab">Two</a></li>
      					<li class="active"><a href="#productsTab" data-toggle="tab">Товары</a></li>
    				</ul>
    				<div class="tab-content">
     					<div class="tab-pane" id="a">Lorem ipsum dolor sit amet, charetra varius quam sit amet vulputate. 
     						Quisque mauris augue, molestie tincidunt condimentum vitae, gravida a libero.
     					</div>
     					<div class="tab-pane" id="b">Secondo sed ac orci quis tortor imperdiet venenatis. Duis elementum auctor accumsan. 
     						Aliquam in felis sit amet augue.
     					</div>

     					<!--  TAB PRODUCTS  -->
     					<div class="tab-pane active" id="productsTab">
     						<div class="row">
     							<div class="col-md-3">
     								<a class="btn btn-link" href="#" data-toggle="modal" data-target="#addProduct">
     									<span class="glyphicon glyphicon-plus"></span> Добавить товар
     								</a>
     							</div>

     							<div id="productsTable" class="col-md-12">
		     						<table class="table table-hover">
		     							<thead>
		     								<tr>
		     									<th>#</th>
		     									<th>Название</th>
		     									<th>Описание</th>
		     									<th>Категория</th>
		     									<th>Цена</th>
		     								</tr>
		     							</thead>
		     							<tbody id="productsList">
		     								<!-- There some place for products -->
		     							</tbody>
		     						</table>
                    <div class='row'>
                      <div class='col-md-2 col-md-offset-5'>
                        <a id='moreProductsBtn' class='btn btn-default' style="display:none;">Еще...</a>
                      </div>
                    </div>
		     					</div>
							</div>
     					</div>
						<!--  end TAB PRODUCTS  -->
    				</div>
  				</div>
			</div>
		</div>
	</div>
</body>
</html>