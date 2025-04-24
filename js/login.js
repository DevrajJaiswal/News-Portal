$(document).ready(function () {

    $('#logInButton').click(function () {
        console.clear()

        error = [];
        userInfo = {}
        let userName = $("#username").val().trim();
        if (userName === '') {
            error.push("Username is required!");
        } else {
            userInfo.username = userName;
        }
        // console.log(userName)

        let userPass = $("#password").val().trim();
        if (userPass == '') {
            error.push("Password is required!");
        } else {
            userInfo.password = userPass;
        }
        // console.log(userPass)

        if (error.length > 0) {
            console.log(error)
        } else {
            jsonInfo = JSON.stringify(userInfo);
            // console.log(jsonInfo);

            $.ajax({
                url: "http://localhost/News_Portal/api/login.php",
                type: "POST",
                data: jsonInfo,
                contentType: "application/json",
                dataType: "json",
                success: function (res) {
                    console.log(res)
                    if (res.status === 200) {
                        window.location.href = "http://localhost/News_Portal/admin/users.php";
                    } else {
                        $(".message").text(res.message);
                        setTimeout(function () {
                            $(".message").hide();
                        }, 2000)
                    }
                },
                error: function (error) {
                    console.log(error);
                }
            })
        }
    })


    $(".admin-logout").click(function () {
        console.log("clicked on Logout")
        $.ajax({
            url: "http://localhost/News_Portal/api/logout.php",
            type: "GET",
            dataType: "json",
            success: function (res) {
                console.log(res)
                if (res.status === 200) {
                    window.location.href = "http://localhost/News_Portal/admin/";
                } else {
                    $(".message").text(res.message);
                    setTimeout(function () {
                        $(".message").hide();
                    }, 2000)
                }
            },
            error: function (error) {
                console.log(error);
            }
        })
    })


})
