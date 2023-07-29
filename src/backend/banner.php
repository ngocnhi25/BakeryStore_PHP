<head>
    <link rel="stylesheet" href="css/table.css">
</head>

<div>
    <h1>Advertising Management</h1>
    <form method="post" enctype="multipart/form-data" action="">
        <div>
            <label for="">Type advertisement</label> <br>
            <select name="typeadvertisement" id="">
                <option value="">____Option____</option>
                <option value="sale">Sale</option>
                <option value="category">Category</option>
                <option value="product">Product</option>
                <option value="news">News</option>
            </select>
        </div>
        <div>
            <label for="">Image advertisement</label> <br>
            <input type="file" name="imageadvertisement">
            
        </div>
        <div>
            <label for="">Start Date</label> <br>
            <input type="date" name="startDate">
        </div>
        <div>
            <label for="">End Date</label> <br>
            <input type="date" name="endDate">
        </div>
    </form>
    <div>
        <table>
            <thead>
                <tr>
                    <th>Type advertisement</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
        </table>
    </div>
</div>