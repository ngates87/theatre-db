/**
 * Created by JetBrains PhpStorm.
 * User: nagates
 * Date: 6/29/11
 * Time: 4:43 PM
 * To change this template use File | Settings | File Templates.
 */
$.validator.setDefaults();

$().ready(function() {
    // validate signup form on keyup and submit
    $("#FrmAdminAdd").validate(
            {
                rules:
                {
                    firstname: "required",
                    lastname: "required",
                    username:
                    {
                        required: true,
                        minlength: 6
                    },
                    password:
                    {
                        required: true,
                        minlength: 8
                    },
                    confirm_password:
                    {
                        required: true,
                        minlength: 8,
                        equalTo: "#password"
                    },
                    email:
                    {
                        required: true,
                        email: true
                    }
                },
                messages:
                {
                    firstname: "Please enter your firstname",
                    lastname: "Please enter your lastname",
                    username:
                    {
                        required: "Please enter a username",
                        minlength: "Your username must consist of at least 6 characters"
                    },
                    password:
                    {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 8 characters long"
                    },
                    confirm_password:
                    {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 8 characters long",
                        equalTo: "Please enter the same password as above"
                    },
                    email: "Please enter a valid email address"
                }
            });
    // propose username by combining first- and lastname
    $("#username").focus(function() {
        var firstname = $("#firstname").val();
        var lastname = $("#lastname").val();
        if (firstname && lastname && !this.value) {
            this.value = firstname + "." + lastname;
        }
    });
});