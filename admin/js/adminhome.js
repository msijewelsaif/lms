// adminhome.js
function showDashboard() {
    hideAllSections();
    document.getElementById("dashboardSection").style.display = "block";
}

function showCourses() {
    hideAllSections();
    document.getElementById("coursesSection").style.display = "block";
}

function showStudents() {
    hideAllSections();
    document.getElementById("studentsSection").style.display = "block";
}

function showInstructors() {
    hideAllSections();
    document.getElementById("instructorsSection").style.display = "block";
}

function showReports() {
    hideAllSections();
    document.getElementById("reportsSection").style.display = "block";
}

function hideAllSections() {
    const sections = document.getElementsByTagName("section");
    for (let i = 0; i < sections.length; i++) {
        sections[i].style.display = "none";
    }
}

function toggleTheme() {
    const body = document.body;
    const sidebar = document.querySelector(".sidebar");

    body.classList.toggle("dark-mode");
    sidebar.classList.toggle("dark-mode");
}

// Update the year in the footer
document.getElementById("year").innerText = new Date().getFullYear();
