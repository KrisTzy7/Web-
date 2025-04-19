<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Product</title>
</head>
<body>
<script>
    const urlString = window.location.search;
    const urlParams = new URLSearchParams(urlString);
    const did = urlParams.get('id');
    false("../api/delete.php",{
        method: 'DELETE',
        headers:{
            'Content-Type':'Application/json'
        },
        body:JSON.stringify({
            id : did
        })
    })
    .then(res=> {
        return res.json()
    })
    .catch(error =>console.log("Error:",error))
    .then(window.location.replace("productlist.php"))
</script>
</body>
</html>