function updateInstructors() {
var courseSelect = document.getElementById("course");
var instructorSelect = document.getElementById("instructor");
var selectedCourse = courseSelect.value;

// Clear current options
instructorSelect.innerHTML = '<option value="">Select an instructor</option>';

if (selectedCourse !== "") {
var instructors = instructorsCourses[selectedCourse];
if (instructors) {
for (var i = 0; i < instructors.length; i++) { var option=document.createElement("option");
    option.value=instructors[i].user_id; option.text=instructors[i].name; instructorSelect.appendChild(option); } } } }
    function validateForm() { var student=document.getElementById("student").value; var
    course=document.getElementById("course").value; var instructor=document.getElementById("instructor").value; if
    (student=="" || course=="" || instructor=="" ) {
    document.getElementById("error-message").innerHTML="Please fill in all fields" ; return false; } return true; 
}