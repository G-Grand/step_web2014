function getProducts(quantProd) {
	prodReq = (quantProd == "all") ? {"count": "all", "number": 0 }	: { "count": "part", "number": quantProd };
	$.ajax({
		url: "getProducts.php",
		//dataType: "json",
		type: "POST",
		data: JSON.stringify(prodReq),
		contentType: "application/json; charset=utf-8;",
		success: function(data) {
			console.log(data);
		}
	});

}

function addNewProduct() {
	var newProduct = {};
	var xmlhttp = new XMLHttpRequest();

	var formElements = document.forms.addProductFormModal.elements;
	for (var i=0; i<formElements.length; ++i){
		if(formElements[i].getAttribute("class").indexOf("form-control") != -1)
			newProduct[formElements[i].getAttribute("name")] = formElements[i].value;
	}

	xmlhttp.open("POST", "addNewProductAJAX.php", true);
	xmlhttp.setRequestHeader('Content-Type', 'application/json')
	xmlhttp.addEventListener("progress", function() {console.log("fdfdf");}, false);
	xmlhttp.onload = function() {
		var resp = JSON.parse(xmlhttp.responseText);
		alert(resp['response']);
	};
	xmlhttp.send(JSON.stringify(newProduct));
	btn.parentNode.childNodes[1].click();
}