$(document).ready(function () {

    // Fetch Users code start 

    console.log("Users")
    function loadUsers(pageNo = 1) {
        const newURL = `?page=${pageNo}`;
        history.pushState({}, '', newURL);

        $.ajax({
            "url": "http://localhost/News_Portal/api/user.php",
            "type": "POST",
            "data": JSON.stringify({
                action: "get_users", page: pageNo
            }),
            "contentType": "application/json",
            "dataType": "json",
            "success": function (res) {
                // console.log(res)
                if (res.status === 200) {
                    let users = res.users;

                    let pageLimit = res.page_limit;

                    let totalUser = res.total_users;

                    allUser = '';
                    let serialNo = (pageNo - 1) * pageLimit + 1;
                    users.forEach(user => {
                        if (user.role == 1) {
                            role = "Admin";
                        } else {
                            role = "Normal User";
                        }
                        allUser += `<tr>
                                    <td class=''>${serialNo}</td>
                                    <td>${user.first_name} ${user.last_name}</td>
                                    <td>${user.username}</td>
                                    <td>${role}</td>
                                    <td class='edit'><span data-id='${user.user_id}' style="cursor:pointer" ><i class='fa fa-edit'></i></span></td>
                                    <td class='delete'><span data-id='${user.user_id}' style="cursor:pointer"><i class='fa fa-trash-o'></i></span></td>
                                </tr>`;
                        serialNo++;
                    });

                    $(".content-table tbody").html(allUser);


                    // Pagination Code start
                    if (totalUser > pageLimit) {
                        totalPage = Math.ceil(totalUser / pageLimit);

                        let pagination = '';
                        if (pageNo > 1) {
                            pre = pageNo - 1;
                            pagination += `<li class='navigate'><span data-page="${pre}" style="cursor:pointer">Prev</span></li>`;
                        }

                        i = 1;
                        while (i <= totalPage) {
                            if (i == pageNo) {
                                isActive = "active";
                            } else {
                                isActive = "";
                            }
                            pagination += `<li class='navigate ${isActive}'><span data-page="${i}" style="cursor:pointer">${i}</span></li>`;
                            i++;
                        }

                        if (pageNo < totalPage) {
                            nex = pageNo + 1;
                            pagination += `<li class='navigate'><span data-page="${nex}" style="cursor:pointer">Next</span></li>`;
                        }
                        $(".pagination").html(pagination);
                        // Pagination Code end
                    }
                } else {
                    console.log(res.message)
                    $(".content-table tbody").html(`<tr><td colspan='6'>${res.message}</td></tr>`);

                }
            },
            "error": function (error) {
                console.log(error);
            }
        })
    }
    loadUsers();
    // Fetch Users code end 


    // Navigate page code start 
    $(document).on('click', ".navigate span", (function () {
        let pageNo = $(this).data("page");
        loadUsers(pageNo);
    }))
    // Navigate page code end 


    // Add user code start 
    $(".add-new").click(function () {
        // console.log("Model form visible")
        $("#modelForm").show()
    })

    $("#closeModelForm").click(function () {
        // console.log("Model form hide")
        $("#modelForm").hide()
    })

    function formValidation() {
        console.clear()
        error = [];
        isValidated = true;
        userInfo = {}

        fName = $("#fname").val().trim()
        console.log(fName)
        if (fName === '') {
            error.push("First Name is blank");
            isValidated = false;
        } else {
            userInfo.fName = fName;
        }

        lName = $("#lname").val().trim()
        console.log(lName)
        if (lName === '') {
            error.push("Last Name is blank");
            isValidated = false;
        } else {
            userInfo.lName = lName;
        }

        userName = $("#user").val().trim()
        console.log(userName)
        if (userName === '') {
            error.push("User Name is blank");
            isValidated = false;
        } else {
            userInfo.userName = userName;
        }

        password = $("#password").val().trim()
        console.log(password)
        if (password == '') {
            error.push("Password is blank");
            isValidated = false;
        } else {
            userInfo.password = password;
        }

        role = parseInt($("#role").val().trim())
        console.log(role)
        console.log(typeof (role))
        if (role === '') {
            error.push("Role is blank");
            isValidated = false;
        } else {
            userInfo.role = role;
        }
        return isValidated;
    }

    $("#saveButton").click(function (e) {
        e.preventDefault()
        console.log("Save Button clicked")

        if (formValidation()) {
            $.ajax({
                "url": "http://localhost/News_Portal/api/user.php",
                "type": "POST",
                "data": JSON.stringify({
                    action: "add_user", userInfo: userInfo
                }),
                "contentType": "application/json",
                "dataType": "json",
                "success": function (res) {
                    // console.log(res)
                    if (res.status === 200) {
                        console.log(res["added user"])

                        $("#userForm")[0].reset();
                        $("#modelForm").hide()
                        loadUsers();
                    } else {
                        console.log(res.message)
                    }
                },
                "error": function (error) {
                    console.log(error);
                }
            })
            console.log(isValidated)
        } else {
            alert("All fields are required!");
            console.log(error);
        }
    })
    // Add user code end 


    // Delete user code start 
    $(document).on('click', ".delete span", (function () {
        let userId = $(this).data("id");

        $.ajax({
            "url": "http://localhost/News_Portal/api/user.php",
            "type": "POST",
            "data": JSON.stringify({
                action: "delete_user", userId: userId
            }),
            "contentType": "application/json",
            "dataType": "json",
            "success": function (res) {
                // console.log(res)
                if (res.status === 200) {
                    console.log(res.message)
                    loadUsers();
                } else {
                    console.log(res.message)
                }
            },
            "error": function (error) {
                console.log(error);
            }
        })
    }))
    // Delete user code end 


})




