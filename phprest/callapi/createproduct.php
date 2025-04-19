<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aa Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
<h1>Add New Product</h1>
<form id="productFrom">
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
  <input type="submit" class="btn btn-primary" value="save">
</form>
</div>
<script>
    document.getElementById("productFrom").addEventListener("submit",(e)=>{
        e.preventDefault();
        let uitem = document.getElementById("item").value;
        let uprice = document.getElementById("price").value;
        let uquantity = document.getElementById("qty").value;
        fetch("../api/create.php",{
            method: 'POST',
            headers: {
                'Content-Type':'application/json'
            },
            body: JSON.stringify({
                item: uitem,
                price: uprice,
                quantity: uquantity
            })
        })
        .then(res =>{
            return res.json()
        })
        .catch(error => console.log("Error:",error))
        .then(alert('Product inserted successfully!'))
    });
</script>
</body>
</html>