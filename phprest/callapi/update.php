<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
<h1>Update Product</h1>
<form id="productFrom">
    <input type="hidden" id="editid">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Product Name</label>
    <input type="text" class="form-control" id="item" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Product Price</label>
    <input type="number" class="form-control" id="price" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Product Quantity</label>
    <input type="number" class="form-control" id="qty" aria-describedby="emailHelp">
  </div>
  <input type="submit" class="btn btn-primary" value="update">
</form>
<br>
<a href="productlist.php" class="btn btn-primary">Product List</a>
</div>
<script>
    const urlString = window.location.search;
    const urlParams = new URLSearchParams(urlString);
    const id = urlParams.get('id');
    
    fetch(`../api/read_single.php?id=${id}`)
    .then(response => response.json())
    .then(product=>{
        let id = product.id;
        let item = product.item;
        let price = product.price;
        let quantity = product.quantity;
        document.getElementById("editid").value=id;
        document.getElementById("item").value=item;
        document.getElementById("price").value=price;
        document.getElementById("qty").value=quantity;
    })
    .catch(error =>console.log("Error:",error))

    document.getElementById("productFrom").addEventListener("submit",(e)=>{
        e.preventDefault();
        let uid = document.getElementById("editid").value;
        let uitem = document.getElementById("item").value;
        let uprice = document.getElementById("price").value;
        let uqty = document.getElementById("qty").value;

        fetch("../api/update.php", {
            method: 'PUT',
            headers: {
                'Content-Type':'Application/json'
            },
            body:JSON.stringify({
                id: uid,
                item: uitem,
                price: uprice,
                quantity: uqty
            })
        })
        .then(res=>{
            return res.json()
        })
        .catch(error=> console.log("Error:",error))
        .then(alert("1 Record updated successfully."))
    });
</script>
</body>
</html>