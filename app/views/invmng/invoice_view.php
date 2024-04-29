<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Supplier Invoice</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="<?php echo APPROOT . '/public/css/invmng/invoice_view.css' ?>">

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
                            if ($data['item']) {
                                $sum = 0;
                                foreach ($data['item'] as $item) {
                                    $sum += (int) $item['price'];
                                    echo "<tr>";
                                    echo "<td>{$item['item_name']}</td>";
                                    echo "<td class='quantity'>{$item['quantity']}</td>";
                                    echo "<td>{$item['unit']}</td>";
                                    echo "<td class='price'>{$item['price']}</td>";
                                    echo"<td class='price'><input class='hidden' type='hidden' value=".$item['item_id']."></input></td>";
                                    echo "<td class='expire_date'>{$item['expire_date']}</td>";
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
                                <td id="total-amount" colspan="2">Rs. <?php echo $sum; ?></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </section>
            </main>

            <footer>
                <button type="button" class="btn-0 btn-2" id="approve" onclick="openModal2('<?php echo $data['order_id'];?>')">
                    <i class="fas fa-file-invoice"></i> Approve
                </button>
                <button type="button" class="btn-0 btn-3" id="reject" onclick="openModal('<?php echo $data['order_id'];?>')">
                    <i class="fas fa-file-invoice"></i> Reject
                </button>
            </footer>
        </div>
    </div>

    <!-- delete waring message -->
    <div id="deleteModal" class="warning-modal">
        <div class="warning-modal-content">
            <span class="close">&times;</span>
            <p>Are you sure you want to Reject?</p>
            <div class="btn-container">
                <button id="yesBtn">Yes</button>
                <button id="noBtn">No</button>
                <input type="hidden" value="" id="hidden_id">
            </div>
        </div>
    </div>

    <script src="<?php echo APPROOT . '/public/js/components/warningModal.js' ?>"></script>

    
    <div class="error-message-container" id="ErrorMessage">
        <div class="icon">
            <lord-icon src="https://cdn.lordicon.com/akqsdstj.json" trigger="in" delay="15" state="in-reveal">
            </lord-icon>
        </div>
        <p id="error_msg">Error! Your action was failed.</p>
        <span class="close-button" onclick="hideSuccessMessage()">×</span>
    </div>



</body>

</html>

<script>
    const table = document.getElementById('invoice-table');
    const totalAmount = document.getElementById('total-amount');

    table.addEventListener('input', (e) => {
        const rows = table.querySelectorAll('tbody tr');
        let total = 0;
        rows.forEach(row => {
            const price = row.querySelector('input[type="number"]').value;
            total += parseFloat(price) || 0;
        });
        totalAmount.textContent = `$${total.toFixed(2)}`;
    });

    const yesbtn = document.getElementById('yesBtn');
    yesbtn.addEventListener('click' ,()=>{
        const order_id = document.getElementById('hidden_id').value;
        const baseLink = window.location.origin;
        const link = `${baseLink}/labora/invmng/rejectOrder`;
        const data = {
            order_id: order_id
        }
        console.log(data);
        fetch(link , {
            method:'POST',
            body: JSON.stringify(data)
        }).then(res => {
            if(!res.ok){
                throw new Error('Network response was not ok');
            }
            return res.json();
        }).then(data => {
            console.log(data);
            if(data.success_msg.trim() !== ""){
                window.location.href = `${baseLink}/labora/invmng/order`;
            }else{
                showErrrorMessage();
            }
        }).catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
    
    })

    // generateInvoice.addEventListener('click', () => {
    //     const rows = table.querySelectorAll('tbody tr');
    //     const items = [];
    //     rows.forEach(row => {
    //         const item = {
    //             price: row.querySelector('input[type="number"]').value,
    //             expireDate: row.querySelector('input[type="date"]').value,
    //             itemId: row.querySelector('.hidden').value
    //         };
    //         items.push(item);
    //     });
    //     console.log(items);



    //     const baseLink = window.location.origin;
    //     const link = `${baseLink}/labora/supplier/sendInvoice`;

    // });
</script>

<!-- delete waring message -->
<div id="deleteModal2" class="warning-modal">
        <div class="warning-modal-content">
            <span class="close2">&times;</span>
            <p>Are you sure you want to Approve?</p>
            <div class="btn-container">
                <button id="yesBtn2">Yes</button>
                <button id="noBtn2">No</button>
                <input type="hidden" value="" id="hidden_id2">
            </div>
        </div>
    </div>

<!-- warning modal for approving -->
<script>

    var modal2 = document.getElementById("deleteModal2");


    var span2 = document.getElementsByClassName("close2")[0];


    var yesBtn2 = document.getElementById("yesBtn2");
    var noBtn2 = document.getElementById("noBtn2");


    span2.onclick = function () {
        modal2.style.display = "none";
    }

    function openModal2(id) {
        console.log('das');
        document.getElementById('hidden_id2').value = id;
        modal2.style.display = "block";
    }

    yesBtn2.onclick = function() {
        var order_id = document.getElementById('hidden_id2').value;
        console.log(order_id);
        const rows = table.querySelectorAll('tbody tr');
        const items = [];
        rows.forEach(row => {
            const item = {
                quantity: parseInt(row.querySelector('.quantity').innerText),
                item_catergory_Id: parseInt (row.querySelector('.hidden').value)
            };
            items.push(item);
        });
        console.log(items);

        const data = {
            items: items,
            order_id: order_id
        }
       
        const baseLink = window.location.origin
        const link = `${baseLink}/labora/invmng/approveInvoice`;

        fetch(link , {
            method:'POST',
            body: JSON.stringify(data)
        }).then(res =>{
            if(!res.ok){
                throw new Error('Network response was not ok');
            }

            return res.json();
        }).then(data =>{
            console.log(data);
            if(data.success_msg.trim() !== "") {
                window.location.href = `${baseLink}/labora/invmng/order`;
            }else{
                showErrrorMessage();
            }
        }).catch(error =>{
            console.error('There was a problem with the fetch operation:', error);
        });

    }

    noBtn2.onclick = function () {
        modal2.style.display = "none";
    }

    window.onclick = function (event) {
        if (event.target == modal2) {
            modal2.style.display = "none";
        }
    }
</script>