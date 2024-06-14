<?php include('nav-admin.php'); ?>

<div class="display-table">
<a class="waves-effect waves-light btn darken-2 logout-btnn" style="background-color: #FFDE59; color: white; float:right; margin-top:0" id="printBtn">Print</a>
<a class="waves-effect waves-light btn darken-2 logout-btnn" style="background-color: #FFDE59; color: white; margin-right: 10px; float:right; margin-top:0" id="exportExcelBtn">Excel</a>
    <table id="myTable" class="table-show">
        <thead>
            <tr>
                <th>Project ID</th>
                <th>Project Name</th>
                <th>Faculty Name</th>
                <th>Department</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $sql = "SELECT a.project_id, a.title AS project_title, f.name AS faculty_name, f.department, a.field_of_work, a.meeting_time, a.meeting_day, a.descriptionn, f.email_address, f.contact_info
            FROM tbl_addproject a 
            JOIN tbl_faculty f ON a.user_id = f.id";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            $sn = 1;
            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $project_id = $row['project_id'];
                    $project_title = $row['project_title'];
                    $faculty_name = $row['faculty_name'];
                    $department = $row['department'];
            ?>
                    <tr>
                        <td><?php echo $project_id; ?></td>
                        <td><?php echo $project_title; ?></td>
                        <td><?php echo $faculty_name; ?></td>
                        <td><?php echo $department; ?></td>
                        <td>
                            <button id="myBtn" type="button" class="btn-floating center"><i class="material-icons grey darken-1">info</i></button>
                            <div id="myModal" class="modaly">
                                <!-- Modal content -->
                                <div class="modaly-content">
                                    <span class="close">&times;</span>
                                    <div class="pop-up-content">
                                        <h2><?php echo $project_title; ?></h2>
                                        <p><em><strong><?php echo $row['field_of_work']; ?></strong></em></p>
                                        <br>
                                        <p><?php echo $row['descriptionn']; ?></p>
                                        <br>
                                        <p>Meeting Day and Timings: <?php echo $row['meeting_day'] . ' ' . $row['meeting_time']; ?></p>
                                        <br>
                                        <h5><?php echo $faculty_name; ?></h5>
                                        <p><?php echo $row['email_address']; ?> <span><?php echo $row['contact_info']; ?></span></p>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
            <?php
                }
            } else {
                echo 'No records found';
            }
            ?>
        </tbody>
    </table>
</div>
<?php include('../admin/footer.php'); ?>
<script>
  document.getElementById("printBtn").addEventListener("click", function() {
    var printContents = document.getElementById("myTable").outerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
  });
  document.getElementById("exportExcelBtn").addEventListener("click", function() {
        var table = document.getElementById("myTable");
        var rows = table.querySelectorAll("tbody tr");

        var csvContent = "data:text/csv;charset=utf-8,";
        var headers = ["Project ID", "Project Name", "Faculty Name", "Department"];

        // Add headers
        csvContent += headers.join(",") + "\n";

        rows.forEach(function(row) {
            var rowData = [];
            var cells = row.querySelectorAll("td");
            // Only include specific columns (Project ID, Project Name, Faculty Name, Department)
            for (var i = 0; i < cells.length - 1; i++) {
                rowData.push(cells[i].textContent.trim());
            }
            csvContent += rowData.join(",") + "\n";
        });

        var encodedUri = encodeURI(csvContent);
        var link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", "project_data.csv");
        document.body.appendChild(link);
        link.click();
    });
</script>