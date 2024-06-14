<?php include('nav-admin.php'); ?>

<div class="display-table">
<a class="waves-effect waves-light btn darken-2 logout-btnn" style="background-color: #FFDE59; color: white; float:right; margin-top:0" id="printBtn">Print</a>
<a class="waves-effect waves-light btn darken-2 logout-btnn" style="background-color: #FFDE59; color: white; margin-right: 10px; float:right; margin-top:0" id="exportExcelBtn">Excel</a>
  <table id="myTable" class="table-show">
    <thead>
      <tr>
        <th>Student ID</th>
        <th>Name</th>
        <th>Year of Graduating</th>
        <th>Department</th> 
        <th>Skilled At</th>
        <th>Email Address</th>
        <th>Contact Info</th> 
      </tr>
    </thead>
    <tbody>
    <?php 
          $sql = "SELECT * FROM tbl_student"; 
          $res = mysqli_query($conn, $sql);
          $count = mysqli_num_rows($res);
          $sn = 1;
          if($count > 0){
            while($row = mysqli_fetch_assoc($res)){
              $student_id = $row['id'];
              $name = $row['name'];
              $year_of_graduating = $row['year_of_graduating'];
              $department = $row['department'];
              $skilled_at = $row['skilled_at'];
              $email_address = $row['email_address'];
              $contact_info = $row['contact_info'];
              ?>
              <tr>
                <td><?php echo $student_id; ?></td>
                <td><?php echo $name; ?></td>
                <td><?php echo $year_of_graduating; ?></td>
                <td><?php echo $department; ?></td>
                <td><?php echo $skilled_at; ?></td>
                <td><?php echo $email_address; ?></td>
                <td><?php echo $contact_info; ?></td>
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
    link.setAttribute("download", "student_data.csv");
    document.body.appendChild(link);
    link.click();
});
</script>