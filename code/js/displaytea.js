function _delete(id) {
  if (confirm("Confirm the deletion? Yes/Cancel")) {
    alert("Row with ID " + id + " will be deleted");
    window.location = "deletetea.php?id=" + id;
  }
}

function _deleteStudent(id) {
  if (confirm("Confirm the deletion? Yes/Cancel")) {
    alert("Row with ID " + id + " will be deleted");
    window.location = "delete.php?id=" + id;
  }
}
