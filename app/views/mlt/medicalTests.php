<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="600; url=http://localhost/labora/user/logout"> -->
    <link rel="stylesheet" href="<?php echo APPROOT . '/public/css/mlt/medicalTests.css' ?>">
    <script src="<?php echo APPROOT . '/public/js/mlt/patient.js'; ?>"></script>
    <!-- static icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- annimation icons -->
    <script src="https://cdn.lordicon.com/lordicon-1.1.0.js"></script>
    <title>MLT dashboard</title>
</head>

<body>
    <?php require_once 'components/nevbar.php' ?>

    <script>
        function openModalDes(id) {
            console.log(id);
            var modal = document.getElementById("customModal");
            modal.style.display = "flex";

            const baseLink = window.location.origin;
            const link = `${baseLink}/labora/MLT/getTestDescription/${id}`;

            fetch(link, {
                method: 'GET'
            }).then(res => {
                if (!res.ok) {
                    throw new Error('Network Error Occurred');
                }
                return res.json();
            }).then(data => {
                document.getElementById('modal_info').innerHTML = data['Description']
            }).catch(err => {
                console.error(err);
            });

        }

        function openModalPre(id) {
            console.log(id);
            var modal = document.getElementById('customModal');
            modal.style.display = 'flex';

            const baseLink = window.location.origin;
            const link = `${baseLink}/labora/MLT/getPreparations/${id}`

            fetch(link)
                .then(res => {
                    if (!res.ok) {
                        throw new Error('Network Error Occur');
                    }
                    return res.json();
                }).then(data => {
                    console.log(data)
                    let mockup = '<ul class="list">'
                    for (let i = 0; i < data.length; i++) {
                        mockup += `<li>${data[i]['preparation']}</li>`
                    }
                    mockup += "</ul>"
                    console.log(mockup);

                    document.getElementById('modal_info').innerHTML = mockup

                }).catch(err => {
                    console.error(err);
                })
        }

        function closeModal() {
            var modal = document.getElementById("customModal");
            modal.style.display = "none";
        }

        window.onclick = function (event) {
            var modal = document.getElementById("customModal");
            if (event.target === modal) {
                modal.style.display = "none";
            }
        };
    </script>

    <div class="container_1">

        <div class="table-container">
            <h2><i class="fa-solid fa-calendar-check"></i>Testing Details</h2>
            <div class="add">
                <a href="<?php echo URLROOT ?>MLT/test_form" class="addbtn"><ion-icon name="add"></ion-icon> Create
                    New</a>
            </div>
            <div class="search-container">
                <input type="text" class="search-box" id="searchInput" placeholder="Search...">
                <button class="search-button">Search</button>
            </div>

            <div class="filter-box">
            </div>
            <table id="myTable">
                <thead>
                    <th>ID</th>
                    <th>Test Name</th>
                    <th>Description</th>
                    <th>preparations</th>
                    <th>Availability</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <div class='table_body'>
                        <?php foreach ($data['test_types'] as $test) {
                            if ($test['availability'] == 1) {
                                $text = "Yes";
                                $class = "btn-0 btn-1";
                            } else {
                                $text = "No";
                                $class = "btn-0 btn-3";
                            }
                            echo "<tr>";
                            echo "<td>" . $test['id'] . "</td>";
                            echo "<td>" . $test['Test_type'] . "</td>";
                            echo "<td><button class='btn-0 btn-2' onclick=\"openModalDes('" . $test['id'] . "')\">View</button></td>";
                            echo "<td><button class='btn-0 btn-2' onclick=\"openModalPre('" . $test['id'] . "')\">View</button></td>";
                            echo "<td><button class='" . $class . "' onclick=\"openModal('" . $test['id'] . "' , 'Are You Sure You Want to Change Status')\">" . $text . "</button></td>";
                            echo "<td><button class='btn-0 btn-3' onclick=\"openModal2('" . $test['id'] . "' , 'Are You Sure You Want to Remove')\")\">Remove</button></td>";
                            echo "</tr>";
                        } ?>
                    </div>
                </tbody>
            </table>
            <div class="pagination">
                <h5 id="table_data"></h5>
                <button onclick="previousPage()" id='prev'>Previous</button>
                <button onclick="nextPage()" id="next">Next</button>
            </div>
        </div>
    </div>


    <!-- change status waring message -->
    <div id="deleteModal" class="warning-modal">
        <div class="warning-modal-content">
            <span class="close">&times;</span>
            <p id="warning_msg">Undefine warning message</p>
            <div class="btn-container">
                <button id="yesBtn">Yes</button>
                <button id="noBtn">No</button>
                <input type="hidden" value="" id="hidden_id">
            </div>
        </div>
    </div>

    <!-- delete waring message -->
    <div id="deleteModal2" class="warning-modal">
        <div class="warning-modal-content">
            <span class="close2">&times;</span>
            <p id="warning_msg2">Undefine warning message</p>
            <div class="btn-container">
                <button id="yesBtn2">Yes</button>
                <button id="noBtn2">No</button>
                <input type="hidden" value="" id="hidden_id2">
            </div>
        </div>
    </div>

    <script src="<?php echo APPROOT . '/public/js/components/warningModal.js' ?>"></script>


    <!-- pop success & error messages -->
    <!-- popup success messages -->
    <div class="success-message-container" id="successMessage">
        <div class="icon">
            <lord-icon src="https://cdn.lordicon.com/guqkthkk.json" trigger="in" delay="15" state="in-reveal">
            </lord-icon>
        </div>
        <p id="success_msg"> Success! Add New Medical Test.</p>
        <span class="close-button" onclick="hideSuccessMessage()">×</span>
    </div>

    <div class="error-message-container" id="ErrorMessage">
        <div class="icon">
            <lord-icon src="https://cdn.lordicon.com/akqsdstj.json" trigger="in" delay="15" state="in-reveal">
            </lord-icon>
        </div>
        <p id="error_msg">Error! Your action was failed.</p>
        <span class="close-button" onclick="hideSuccessMessage()">×</span>
    </div>



    <!-- Modal -->
    <div class="modal" id="customModal">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Medical Test Details</h4>
                <button type="button" onclick="closeModal()">&times;</button>
            </div>
            <div class="modal-body">
                <p id="modal_info">Data Not Found</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-primary" onclick="closeModal()">Close</button>
            </div>
        </div>
    </div>
    </div>

    <script>
        window.onload = showMessage();

        function showMessage() {
            let success = <?php echo isset($_SESSION['success_msg']) ? json_encode($_SESSION['success_msg']) : ''; ?>;
            <?php unset($_SESSION['success_msg']); ?>;
            if (success.trim() !== '') {
                showSuccessMessage();
            }
        }
    </script>


    <!-- change availability status -->
    <script>
        let yesBtn1 = document.getElementById('yesBtn');
        yesBtn1.addEventListener('click', () => {
            console.log('yes clicked');
            let id = document.getElementById('hidden_id').value;
            console.log(id);
            const baseLink = window.location.origin;
            const link = `${baseLink}/labora/MLT/changeAvailabilityStatus/${id}`;

            fetch(link)
                .then(res => {
                    if (!res.ok) {
                        throw new Error('Network Error Occurred');
                    }
                    return res.json();
                })
                .then(data => {
                    console.log(data);
                    location.reload();
                })
                .catch(err => {
                    console.error(err);
                });
        });

    </script>

    <!-- remove test -->

    <script>

        var modal2 = document.getElementById("deleteModal2");


        var span2 = document.getElementsByClassName("close2")[0];


        var yesBtn2 = document.getElementById("yesBtn2");
        var noBtn2 = document.getElementById("noBtn2");


        span2.onclick = function () {
            modal2.style.display = "none";
        }

        function openModal2(id, msg = '') {
            console.log(id)

            if (msg != '') {
                document.getElementById('warning_msg2').innerHTML = msg
            }
            document.getElementById('hidden_id2').value = id;
            modal2.style.display = "block";
        }

        noBtn2.onclick = function () {
            modal2.style.display = "none";
        }

        window.onclick = function (event) {
            if (event.target == modal) {
                modal2.style.display = "none";
            }
        }

        let yesBtn3 = document.getElementById('yesBtn2');
        yesBtn3.addEventListener('click', () => {
            let id = document.getElementById('hidden_id2').value;
            const baseLink = window.location.origin;
            const link_2 = `${baseLink}/labora/MLT/removeTest/${id}`;

            fetch(link_2)
                .then(res => {
                    if (!res.ok) {
                        throw new Error('Network Error Occurred');
                    }
                    return res.json();
                })
                .then(data => {
                    console.log(data);
                    location.reload();
                })
                .catch(err => {
                    console.error(err);
                });
        })

    </script>

    <!-- import table javascript -->
    <script src="<?php echo APPROOT . '/public/js/components/table.js' ?>"></script>
</body>

</html>