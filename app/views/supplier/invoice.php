<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Supplier Invoice</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="<?php echo APPROOT . '/public/css/supplier/invoice.css' ?>">

</head>

<body>
    <?php require_once 'components/nevbar.php' ?>
    <div class="container_1">
        <div class="container_9">
            <header>
                <h1><i class="fa-solid fa-file-invoice"></i> Supplier Invoice<br>
                    <p style="color:#a1a1a1;font-size:14px;">You Can Send Invoice Using this form</p>
                </h1>

                <div class="company-info">
                    <div>
                        <h2><?php echo $data['supplier']['full_name'] ?></h2>
                        <p><?php echo $data['supplier']['email'] ?></p>
                        <p><?php echo $data['supplier']['phone'] ?></p>
                    </div>
                </div>
            </header>

            <main>
                <section>
                    <h3><i class="fas fa-box"></i> Invoice Items</h3>
                    <table id="invoice-table">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Unit</th>
                                <th>Price (Rs.)</th>
                                <th>Expire Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $today = date('Y-m-d');
                            if ($data['item']) {
                                foreach ($data['item'] as $item) {
                                    echo "<tr>";
                                    echo "<td>{$item['item_name']}</td>";
                                    echo "<td>{$item['quantity']}</td>";
                                    echo "<td>{$item['unit']}</td>";
                                    echo "<td>
                                        <input type='number' placeholder='Price' min='0' step='0.01' />
                                        <input type='hidden' class='hidden' value=" . $item['id'] . " />
                                    </td>
                                    <td>
                                        <input type='date' min=".$today." placeholder='Expire Date' />
                                    </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6'>No items found</td></tr>";
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="total-label">Total:</td>
                                <td id="total-amount" colspan="2">Rs. 0.00</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </section>
            </main>

            <footer>
                <button type="button" id="generate-invoice">
                    <i class="fas fa-file-invoice"></i> Generate Invoice
                </button>
            </footer>
        </div>
    </div>


</body>

</html>

<script>
    const table = document.getElementById('invoice-table');
    const totalAmount = document.getElementById('total-amount');
    const generateInvoice = document.getElementById('generate-invoice');

    table.addEventListener('input', (e) => {
        const rows = table.querySelectorAll('tbody tr');
        let total = 0;
        rows.forEach(row => {
            const price = row.querySelector('input[type="number"]').value;
            total += parseFloat(price) || 0;
        });
        totalAmount.textContent = `$${total.toFixed(2)}`;
    });

    generateInvoice.addEventListener('click', () => {
        const rows = table.querySelectorAll('tbody tr');
        const items = [];
        rows.forEach(row => {
            const item = {
                price: row.querySelector('input[type="number"]').value,
                expireDate: row.querySelector('input[type="date"]').value,
                itemId: row.querySelector('.hidden').value
            };
            items.push(item);
        });
        console.log(items);

        

        const baseLink = window.location.origin;
        const link = `${baseLink}/labora/supplier/sendInvoice`;

        fetch(link, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                items
            })
        }).then(response => response.json())
            .then(data => {
                console.log('Success:', data);
                if(data.success_msg){
                    window.location.replace(`${baseLink}/labora/supplier/orders`);
                }else{
                    showErrorMessage();
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
</script>