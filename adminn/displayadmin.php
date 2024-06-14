<?php include('nav-admin.php'); ?>

<div class="display-table">
<a class="waves-effect waves-light btn darken-2 logout-btnn" style="background-color: #FFDE59; color: white; float:right; margin-top:0" id="printBtn">Print</a>
<a class="waves-effect waves-light btn darken-2 logout-btnn" style="background-color: #FFDE59; color: white; margin-right: 10px; float:right; margin-top:0" id="exportExcelBtn">Excel</a>
  <table id="myTable" class="table-show">
    <thead>
      <tr>
        <th>Admin ID</th>
        <th>Name</th>
        <th>Department</th> 
        <th>Email Address</th> 
        <th>Contact Info</th> 
      </tr>
    </thead>
    <tbody>
    <?php 
          $sql = "SELECT * FROM tbl_admin"; 
          $res = mysqli_query($conn, $sql);
          if($res && mysqli_num_rows($res) > 0){
            while($row = mysqli_fetch_assoc($res)){
              $admin_id = $row['id'];
              $name = $row['name'];
              $department = $row['department'];
              $email = $row['email_address'];
              $contact = $row['contact_info'];
              ?>
              <tr>
                <td><?php echo $admin_id; ?></td>
                <td><?php echo $name; ?></td>
                <td><?php echo $department; ?></td>
                <td><?php echo $email; ?></td>
                <td><?php echo $contact; ?></td>
              </tr>
              <?php
            }
          } else {
            echo '<tr><td colspan="5">No records found</td></tr>';
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
    link.setAttribute("download", "admin_data.csv");
    document.body.appendChild(link);
    link.click();
});
</script>