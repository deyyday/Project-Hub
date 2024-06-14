<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script><script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function() {
    $('#myTable').DataTable();
});
$('.btn-floating button').on('click',function(){ $('#exampleModal').modal('show'); })
$('.modal').modal('hide');
$('body').removeClass('modal-open');
$('.modal-backdrop').remove();
</script>
<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on the button, open the modal
    btn.onclick = function() {
        modal.style.display = "block";
    }
    span.onclick = function() {
        modal.style.display = "none";
    }
    function changeBackground(input) {
        input.style.backgroundColor = 'black';
        input.style.color = 'white';
    }
    function resetStyle(element) {
    element.style.backgroundColor = 'white';
    element.style.color = 'black';
  }
    // When the user clicks on <span> (x), close the modal
    
</script>

</body>
</html>