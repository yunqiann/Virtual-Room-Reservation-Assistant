<html>

<head>
    <title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <style>
    </style>
</head>

<body>
    <form id="login_form">
        <label>帳號 : </label>
        <input type="text" id="date"><br>
        <label for="time">密碼 : </label>
        <input type="text" id="time">
        <!-- <label for="room">房間 : </label>
        <input type="text" id="time" name="time">
        <label for="time">密碼 : </label>
        <input type="text" id="time" name="time">
        <label for="time">密碼 : </label>
        <input type="text" id="time" name="time"> -->
        <!-- <label for="selected_date">Date : </label>
        <input type="text" id="selected_date" name="selected_date"><br>
        <label for="time">Time : </label>
        <input type="text" id="time" name="time"> -->
        <!-- <div>
            <label>Date: </label><br>
            <input type="text" id="selected_date">
        </div>
        <div>
            <label>Time:</label> <br>
            <input id="time">
        </div>
        <div>
            <label>Room: <br><input id="room"></label>
        </div>
        <div>
            <label>Host(Email Address):</label><br>
            <input id="host-email">
        </div>
        <div>
            <label>Member(Email Addresses):</label><br>
            <input id="member-email1"><br>
            <input id="member-email2"><br>
            <input id="member-email3"><br>
            <input id="member-email4"><br>
        </div> -->
        <div>
            <div>
                <button type="submit" id="save">Save</button>
                <button type="cancel">Cancel</button>
            </div>
        </div>
    </form>
    <div id="result"></div>
    <script>
        $(function() {
            $("#save").click(function() {
                //alert($("#login_form").serialize());
                $.ajax({
                    type: "POST",
                    url: "testroute.php",
                    dataType: "JSON",
                    data: {
                        // $("#login_form").serialize()
                        date: $("#date").val(),
                        time: $("#time").val()
                    },
                    success: function(data) {
                        var date = data.date;
                        var time = data.time;
                        // var room = data.room;
                        // var email = data.email;
                        // var member1 = data.member1;
                        // var member2 = data.member2;
                        // var member3 = data.member3;
                        // var member4 = data.member4;
                        var result = "Date:" + date + " Time:" + time;
                        $("#result").html(result);
                    },
                    error: function(xhr) {
                        alert(xhr.status);
                    }
                });
                return false;
            });
        });
    </script>
</body>

</html>