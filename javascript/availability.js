var table = document.getElementById("Availability");
var selected_date = sessionStorage.getItem("selected_date");
//console.log(selected_date);

document.getElementById("selected_date").innerHTML = selected_date;

function sameCol() {

    var col_array = [];
    for (var i = 1; i < table.rows.length; i++) {
        for (var j = 1; j < table.rows[i].cells.length; j++) {
            if (table.rows[i].cells[j].className == "on") {
                col_array.push(j);
            }
        }
    }

    var k = 0;
    if (col_array.length == 0) {
        return true;
    } else {
        k = col_array[0];
    }

    for (var i = 0; i < col_array.length; i++) {
        if (col_array[i] != k) {
            return false;
        }
    }

    return true;
}


function cellBGColor(tableCell) {

    var j = document.getElementsByClassName("td");
    for (var i = 0; i < j.length; i++) {
        j[i].className = "";
    }

    //選取&取消選取格子   
    if (tableCell.className == "on") {
        tableCell.className = "off";
    } else {
        tableCell.className = "on";
    }

}


if (table != null) {
    for (var i = 1; i < table.rows.length; i++) {
        for (var j = 1; j < table.rows[i].cells.length; j++) {
            table.rows[i].cells[j].onclick = function () {
                if (this.className != "not_available") {
                    cellBGColor(this);
                }
            }
        }
    }
}

//清除所有選取
function clearSelected() {
    for (var i = 1; i < table.rows.length; i++) {
        for (var j = 1; j < table.rows[i].cells.length; j++) {
            if (table.rows[i].cells[j].className != "not_available") {
                table.rows[i].cells[j].className = "off"
            }
        }
    }
}



//確認選取的時段
function confirmTimeSlot() {
    var window_txt = "Please confirm the selected time slots and room.\n"
    var timeStr = "Time: \n";
    var roomStr = "Room: ";
    var tmpRoom = "";
    var time_arr = [];

    if (sameCol()) {
        for (var i = 1; i < table.rows.length; i++) {
            for (var j = 1; j < table.rows[i].cells.length; j++) {
                if (table.rows[i].cells[j].className == "on") {
                    timeStr += table.rows[i].cells[0].innerHTML;
                    time_arr.push(table.rows[i].cells[0].innerHTML);
                    tmpRoom = table.rows[0].cells[j].innerHTML;
                    timeStr += "\n";
                }
            }
        }
        roomStr += tmpRoom;
        roomStr += "\n"
        window_txt += roomStr;
        window_txt += timeStr;
        var cf = window.confirm(window_txt);

        modal_time = "";
        for (var i = 0; i < time_arr.length; i++) {
            if (i != time_arr.length - 1) {
                modal_time += time_arr[i];
                modal_time += ", "
            } else {
                modal_time += time_arr[i];
            }
        }

        //確定->彈出型視窗(輸入詳細資訊)
        if (cf == true) {
            $('#myModal').modal('toggle');
            document.getElementById("room").innerHTML = tmpRoom;
            document.getElementById("time").innerHTML = modal_time;
        } else {
            clearSelected();
            alert("Please try again.\n");
        }
    } else {
        alert("You can only select one room per reservation.\nPlease try again.\n");
        clearSelected();
    }
}

function getTimeSlotArray() {
    var time_arr = [];
    if (sameCol()) {
        for (var i = 1; i < table.rows.length; i++) {
            for (var j = 1; j < table.rows[i].cells.length; j++) {
                if (table.rows[i].cells[j].className == "on") {
                    time_arr.push(i - 1);
                }
            }
        }
    }
    return time_arr;
}

function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;

    return [year, month, day].join('-');
}