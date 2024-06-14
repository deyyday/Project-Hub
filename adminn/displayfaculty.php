<?php include('nav-admin.php'); ?>

<div class="display-table">
<a class="waves-effect waves-light btn darken-2 logout-btnn" style="background-color: #FFDE59; color: white; float:right; margin-top:0" id="printBtn">Print</a>
<a class="waves-effect waves-light btn darken-2 logout-btnn" style="background-color: #FFDE59; color: white; margin-right: 10px; float:right; margin-top:0" id="exportExcelBtn">Excel</a>
 <table id="myTable" class="table-show">
    <thead>
      <tr>
        <th>Faculty ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Contact Info</th> 
        <th>Designation</th> 
        <th>Department</th> 
      </tr>
    </thead>
    <tbody>
    <?php 
          $sql = "SELECT id, name, email_address, contact_info, designation, department FROM tbl_faculty";
          $res = mysqli_query($conn, $sql);
          if(mysqli_num_rows($res) > 0) {
            while($row = mysqli_fetch_assoc($res)){
              $faculty_id = $row['id'];
              $name = $row['name'];
              $email = $row['email_address'];
              $contact_info = $row['contact_info'];
              $designation = $row['designation'];
              $department = $row['department'];
              ?>
              <tr>
                <td><?php echo $faculty_id; ?></td>
                <td><?php echo $name; ?></td>
                <td><?php echo $email; ?></td>
                <td><?php echo $contact_info; ?></td>
                <td><?php echo $designation; ?></td>
                <td><?php echo $department; ?></td>
              </tr>
              <?php
            }
          } else {
            echo '<tr><td colspan="6">No faculty found</td></tr>';
          }
        ?>
    </tbody>
  </table>
</div>
<?php include('../admin/footer.php'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.3/xlsx.full.min.js"></script>

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
    var rows = table.querySelectorAll("tr");
    var csvContent = "data:text/csv;charset=utf-8,";

    rows.forEach(function(row) {
        var rowData = [];
        row.querySelectorAll("th, td").forEach(function(cell) {
            rowData.push(cell.textContent.trim());
        });
        csvContent += rowData.join(",") + "\n";
    });

    var encodedUri = encodeURI(csvContent);
    var link = document.createElement("a");
    link.setAttribute("href", encodedUri);
    link.setAttribute("download", "faculty_data.csv");
    document.body.appendChild(link);
    link.click();
});

</script>