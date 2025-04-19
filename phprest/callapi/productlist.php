<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Product List</h1>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>
                    <a href="createproduct.php" class="btn btn-primary">Add New Product</a>
                </th>
            </tr>
        </thead>
        <tbody id="tableRow"></tbody>
    </table>
    <div id="error-message" class="alert alert-danger d-none" role="alert"></div>
</div>

<script>
    // Function to fetch products and populate the table
    function fetchProducts() {
        fetch("../api/read.php")
            .then(response => response.json())
            .then(response => {
                const product = response.products;
                let rows = '';
                product.forEach(record => {
                    rows += `
                        <tr>
                            <td>${record.id}</td>
                            <td>${record.item}</td>
                            <td>${record.price}</td>
                            <td>${record.quantity}</td>
                            <td>
                                <a href="update.php?id=${record.id}" class="btn btn-outline-warning">Edit</a>
                                <button class="btn btn-outline-danger" onclick="deleteProduct(${record.id})">Delete</button>
                            </td>
                        </tr>`;
                });
                document.getElementById("tableRow").innerHTML = rows;
            })
            .catch(error => {
                console.log("Error:", error);
                document.getElementById("error-message").textContent = "Failed to load products.";
                document.getElementById("error-message").classList.remove("d-none");
            });
    }
    // Function to delete a product
    function deleteProduct(id) {
        if (confirm('Are you sure you want to delete this product?')) {
            fetch(`../api/delete.php`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ id: id })
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                fetchProducts(); // Refresh the product list
            })
            .catch(error => {
                console.log("Error:", error);
                alert("Failed to delete the product.");
            });
        }
    }
    // Fetch products when the page loads
    fetchProducts();
</script>
</body>
</html>