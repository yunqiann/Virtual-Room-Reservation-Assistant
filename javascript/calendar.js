let today = new Date();
let currentMonth = today.getMonth();
let currentYear = today.getFullYear();
let selectYear = document.getElementById("year");
let selectMonth = document.getElementById("month");

let months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

let monthAndYear = document.getElementById("monthAndYear");
showCalendar(currentMonth, currentYear);

function next() {
    if (currentMonth === 11) {
        currentYear = currentYear + 1;
    } else {
        currentYear = currentYear;
    }

    currentMonth = (currentMonth + 1) % 12;
    showCalendar(currentMonth, currentYear);
}

function previous() {
    if (currentMonth === 0) {
        currentYear = currentYear - 1;
    } else {
        currentYear = currentYear;
    }
    if (currentMonth === 0) {
        currentMonth = 11;
    } else {
        currentMonth = currentMonth - 1;
    }
    showCalendar(currentMonth, currentYear);
}

function jump() {
    currentYear = parseInt(selectYear.value);
    currentMonth = parseInt(selectMonth.value);
    showCalendar(currentMonth, currentYear);
}

function showCalendar(month, year) {

    let firstDay = (new Date(year, month)).getDay();
    let daysInMonth = 32 - new Date(year, month, 32).getDate();

    let tbl = document.getElementById("calendar-body"); // body of the calendar

    // clearing all previous cells
    tbl.innerHTML = "";

    // filing data about month and in the page via DOM.
    monthAndYear.innerHTML = months[month] + " " + year;
    selectYear.value = year;
    selectMonth.value = month;

    // creating all cells
    let date = 1;
    for (let i = 0; i < 6; i++) {
        // creates a table row
        let row = document.createElement("tr");

        //creating individual cells, filing them up with data.
        for (let j = 0; j < 7; j++) {
            if (i === 0 && j < firstDay) {
                let cell = document.createElement("td");
                let cellText = document.createTextNode("");
                cell.appendChild(cellText);
                row.appendChild(cell);
            } else if (date > daysInMonth) {
                break;
            } else {
                let cell = document.createElement("td");
                let cellText = document.createTextNode(date);
                /*if (date === today.getDate() && year === today.getFullYear() && month === today.getMonth()) {
                     cell.classList.add("bg-info");
                 }*/ // color today's date
                cell.appendChild(cellText);
                row.appendChild(cell);
                date++;
            }


        }

        tbl.appendChild(row); // appending each row into calendar body.
    }

    //點擊顯示日期
    var table = document.getElementById("calendar");
    if (table != null) {
        for (var i = 1; i < table.rows.length; i++) {
            for (var j = 0; j < table.rows[i].cells.length; j++) {
                table.rows[i].cells[j].onclick = function () {
                    var window_text = "The date you choose is ";
                    var date_text = "";
                    date_text += months[month];
                    date_text += " ";
                    date_text += this.innerHTML;
                    date_text += " ";
                    date_text += String(currentYear);
                    // date_text += String(currentYear);
                    // date_text += "/";
                    // date_text += month;
                    // date_text += "/";
                    // date_text += this.innerHTML;
                    // window_text += date_text;
                    var w_confirm = window.confirm(window_text);
                    if (w_confirm) {
                        var selected_date = date_text;
                        sessionStorage.setItem("selected_date", selected_date);
                        window.location.href = "availability.php";
                    }
                };
            }
        }
    }

}