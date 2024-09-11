

function singleProduct(id) {
    window.location = 'singleProduct.php?id=' + id;
}


function signIn() {

    var uname = document.getElementById('uname').value;
    var pass  = document.getElementById('pass').value;
    var check = document.getElementById('check').checked;

    var form = new FormData();
    form.append('uname', uname);
    form.append('pass', pass);
    form.append('check', check);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200 ) {
            if (request.responseText == 'success') {
                window.location = 'index.php';
            } else {
                document.getElementById('err').innerHTML = request.responseText;
                document.getElementById('msg').className = "d-block";
                document.getElementById('msg').className = "bg-danger p-3";
            }
        }
    };
    request.open('POST', 'signInProccess.php', true);
    request.send(form);

}

function signUp() {
    
    var f = document.getElementById('f').value;
    var l = document.getElementById('l').value;
    var m = document.getElementById('m').value;
    var e = document.getElementById('e').value;
    var p = document.getElementById('p').value;
 
    var form = new FormData();
    form.append('f', f);
    form.append('l', l);
    form.append('m', m);
    form.append('e', e);
    form.append('p', p);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            // alert(request.responseText);
            if (request.responseText == 'success') {
                window.location = 'signIn.php';
            } else {
                document.getElementById('err').innerHTML = request.responseText;
                document.getElementById('msg').className = "d-block";
                document.getElementById('msg').className = "bg-danger p-3";
            }
        }
    };
    request.open('POST', 'signUpProcces.php', true);
    request.send(form);

}


var fpm;

function forgotPassword() {

    var e = document.getElementById('uname').value;
    
    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var t = request.responseText;
            if (t == "Success") {
                Swal.fire({
                    icon: "success",
                    background: "#000000",
                    color: "#ffffff",
                    title: "Success.",
                    text: "Verification code has sent to your email. Please check your inbox.,",
                });
                var m = document.getElementById("forgotPasswordModal");
                fpm = new bootstrap.Modal(m);
                fpm.show();
            } else {
                alert(t);
            }
        }
    };

    request.open("GET", "forgotPasswordProcess.php?e=" + e, true);
    request.send();


}



function ShowPassword() {

    var i = document.getElementById("npi");
    var eye = document.getElementById("e1");

    if (i.type == "password") {
        i.type = "text";
        eye.className = "bi bi-eye-fill";
    } else {
        i.type = "password";
        eye.className = "bi bi-eye-slash-fill";
    }

}

function ShowPassword2() {

    var i = document.getElementById("rnp");
    var eye = document.getElementById("e2");

    if (i.type == "password") {
        i.type = "text";
        eye.className = "bi bi-eye-fill";
    } else {
        i.type = "password";
        eye.className = "bi bi-eye-slash-fill";
    }

}

function resetpw() {

    var email = document.getElementById("uname");
    var np = document.getElementById("npi");
    var rnp = document.getElementById("rnp");
    var vcode = document.getElementById("vc");

    var f = new FormData();
    f.append("e", email.value);
    f.append("n", np.value);
    f.append("r", rnp.value);
    f.append("v", vcode.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var t = r.responseText;
            if (t == "success") {

                fpm.hide();
                Swal.fire({
                    icon: "success",
                    background: "#000000",
                    color: "#ffffff",
                    title: "Congradulations.",
                    text: "Password reset successfull.",
                    showConfirmButton: false,
                    timer: 1500
                });

            } else {
                Swal.fire({
                    icon: "error",
                    background: "#000000",
                    color: "#ffffff",
                    title: "Oops...",
                    text: t
                });
            }

        }
    };

    r.open("POST", "resetPassword.php", true);
    r.send(f);

}


function addToCart(id) {

    var qty = document.getElementById('qty').value;
    var clr = document.getElementById('color').value;

    if (qty <= 0) {
        Swal.fire({
            icon: "error",
            background: "#000000",
            color: "#ffffff",
            title: "Oops...",
            text: "invslif quantity"
        });
    } else {
        var request = new XMLHttpRequest();
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                if (request.responseText == 'error') {
                    window.location = 'signIn.php';
                } else {
                    if (request.responseText == 'success') {
                        Swal.fire({
                            icon: "success",
                            background: "#000000",
                            color: "#ffffff",
                            title: "Congradulations.",
                            text: "Successfuly added to cart.",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            background: "#000000",
                            color: "#ffffff",
                            title: "Oops...",
                            text: request.responseText
                        });
                    }
                }
            }
        };
        request.open('GET', 'cartProccess.php?id=' + id + '&qty=' + qty + '&clr=' + clr, true);
        request.send();
    }

}


function addToWishList(id) {

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            if (request.responseText == 'success') {
                Swal.fire({
                    icon: "success",
                    background: "#000000",
                    color: "#ffffff",
                    title: "Congradulations.",
                    text: "Successfuly added to wish list.",
                    showConfirmButton: false,
                    timer: 1500
                });
            } else if(request.responseText == 'update'){                
                Swal.fire({
                    icon: "error",
                    background: "#000000",
                    color: "#ffffff",
                    title: "Oops...",
                    text: "Already have an added."
                });
            } else {
                window.location = 'signIn.php';
            }
        }
    };
    request.open('GET', 'addToWishList.php?id=' + id, true);
    request.send();

}


function buyNow(pId) {
    
    var qty = document.getElementById('qty').value;
    var color = document.getElementById('color').value;
    var price = document.getElementById('price').innerHTML;    
    var dis = document.getElementById('dis_value').innerHTML;    
    var dis_id = document.getElementById('dis_id').innerHTML;    
    var avbqty = document.getElementById('avbqty').innerHTML;

    
    if (qty <= 0) {
        Swal.fire({
            icon: "error",
            background: "#000000",
            color: "#ffffff",
            title: "Oops...",
            text: "Invalid Quantity.",
        });
    } else {
        
        var form = new FormData();
        form.append('id', pId);
        form.append('qty', qty);
        form.append('color', color);
        form.append('pri', price);

        var request = new XMLHttpRequest();
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {

                if (request.responseText == 0) {
                    window.location = 'signIn.php';
                } else if(request.responseText == 1) {
                    Swal.fire({
                        icon: "error",
                        background: "#000000",
                        color: "#ffffff",
                        title: "Oops...",
                        text: "Please update your address book.",
                    });
                } else if (request.responseText == 2) {
                    Swal.fire({
                        icon: "error",
                        background: "#000000",
                        color: "#ffffff",
                        title: "Oops...",
                        text: "Please select valid quantity.Select less than " + avbqty + ".",
                    });
                } else if (request.responseText == 3) {
                    Swal.fire({
                        icon: "error",
                        background: "#000000",
                        color: "#ffffff",
                        title: "Oops...",
                        text: "Please select a colour,",
                    });
                    bm.show();
                } else {
                    $obj = JSON.parse(request.responseText);
                    // Payment completed. It can be a successful failure.
                    payhere.onCompleted = function onCompleted(orderId) {

                        var form = new FormData();
                        form.append('q', qty);
                        form.append('c', color);
                        form.append('pId', pId)
                        form.append('pri', price);
                        form.append('dis', dis);
                        form.append('dis_id', dis_id);
                        form.append('avb', avbqty);

                        var request = new XMLHttpRequest();
                        request.onreadystatechange = function() {
                            if (request.readyState == 4 && request.status == 200) {
                                
                                // $Obj = JSON.parse(request.responseText);
                                if (request.response == 'Success') {
                                    Swal.fire({
                                        icon: "success",
                                        background: "#000000",
                                        color: "#ffffff",
                                        title: "Success.",
                                        text: "Please check My Account -> My Orders and set shipping address for proccess order.",
                                    });
                                }

                            }
                        };
                        request.open('POST', 'addOrder.php', true);
                        request.send(form);
                    };
        
                    // Payment window closed
                    payhere.onDismissed = function onDismissed() {
                        // Note: Prompt user to pay again or show an error page
                        console.log("Payment dismissed");
                    };
        
                    // Error occurred
                    payhere.onError = function onError(error) {
                        // Note: show an error page
                        console.log("Error:"  + error);
                    };
        
                    // Put the payment variables here
                    var payment = {
                        "sandbox": true,
                        "merchant_id": "1226423",    // Replace your Merchant ID
                        "return_url": "http://localhost/NEO/invoice.php",     // Important
                        "cancel_url": "http://localhost/NEO/singleProduct.php?id=1012345",     // Important
                        "notify_url": "http://sample.com/notify",
                        "order_id": $obj.order_id,
                        "items": $obj.item,
                        "amount": $obj.amount,
                        "currency": $obj.currency,
                        "hash": $obj.hash, // *Replace with generated hash retrieved from backend
                        "first_name": $obj.fname,
                        "last_name": $obj.lname,
                        "email": $obj.email,
                        "phone": $obj.phone,
                        "address": $obj.addres,
                        "city": $obj.city,
                        "country": $obj.country,
                        "delivery_address": $obj.addres,
                        "delivery_city": $obj.city,
                        "delivery_country": $obj.country,
                        "custom_1": "",
                        "custom_2": ""
                    };
                    
                    payhere.startPayment(payment);
        
                    // Show the payhere.js popup, when "PayHere Pay" is clicked
                    document.getElementById('payhere-payment').onclick = function (e) {
                        payhere.startPayment(payment);
                    };
                }
            }
        };
        request.open('POST', 'paymentProccess.php', true);
        request.send(form);
    }
}


function cartCheckOut() {

    var price = document.getElementById('price').innerHTML;
    
    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if(request.status == 200 && request.readyState == 4) {
            // alert(request.responseText);
            $obj = JSON.parse(request.responseText);
            // Payment completed. It can be a successful failure.
            payhere.onCompleted = function onCompleted(orderId) {

                var c_code = document.getElementById('c_code').value;
                var dis = document.getElementById('dis_value').innerHTML;    
                var dis_id = document.getElementById('dis_id').innerHTML;  
                
                var request = new XMLHttpRequest();
                request.onreadystatechange = function() {
                    if (request.readyState == 4 && request.status == 200) {
                        // alert(request.responseText);
                        if (request.responseText == 'Success') {
                            Swal.fire({
                                icon: "success",
                                background: "#000000",
                                color: "#ffffff",
                                title: "Success.",
                                text: "Please check My Account -> My Orders and set shipping address for proccess order.",
                            });
                        }
                    }
                };
                request.open('GET', 'addCartOrder.php?c_code=' + c_code + '&price=' + price + '&dis=' + dis + '&dis_id=' + dis_id, true);
                request.send();
                
                
            };

            // Payment window closed
            payhere.onDismissed = function onDismissed() {
                // Note: Prompt user to pay again or show an error page
                console.log("Payment dismissed");
            };

            // Error occurred
            payhere.onError = function onError(error) {
                // Note: show an error page
                console.log("Error:"  + error);
            };

            // Put the payment variables here
            var payment = {
                "sandbox": true,
                "merchant_id": "1226423",    // Replace your Merchant ID
                "return_url": "http://localhost/NEO/cart.php",     // Important
                "cancel_url": "http://localhost/NEO/cart.php",     // Important
                "notify_url": "http://sample.com/notify",
                "order_id": $obj.order_id,
                "items": $obj.item,
                "amount": $obj.amount,
                "currency": $obj.currency,
                "hash": $obj.hash, // *Replace with generated hash retrieved from backend
                "first_name": $obj.fname,
                "last_name": $obj.lname,
                "email": $obj.email,
                "phone": $obj.phone,
                "address": $obj.addres,
                "city": $obj.city,
                "country": $obj.country,
                "delivery_address": $obj.addres,
                "delivery_city": $obj.city,
                "delivery_country": $obj.country,
                "custom_1": "",
                "custom_2": ""
            };

            payhere.startPayment(payment);
        }
    };
    request.open('GET', 'cartPayment.php?price=' + price, true);
    request.send();
    
}

function adminSignIn() {
    
    var email = document.getElementById('adminEmail');
    
    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status == 200) {
            if (request.responseText == 'Success') {
                document.getElementById('pwd-box').classList = 'd-block';
                document.getElementById('err').innerHTML = "Check your email and get current password.";
                document.getElementById('msg').classList = "d-block";
                document.getElementById('signInBtn').classList = 'd-none';
                document.getElementById('passwordCheckBtn').classList = 'd-block';
                document.getElementById('passwordCheckBtn').classList = 'btn-signIn';
            } else {
                document.getElementById('err').innerHTML = request.responseText;
                document.getElementById('msg').className = "d-block";
                document.getElementById('msg').className = "bg-danger p-1 mb-3";
            }
        }
    };
    request.open('GET', 'adminPassworSending.php?em=' + email.value, true);
    request.send();
    
}

function passwordChecker() {
    
    var password = document.getElementById('password').value;
    var email = document.getElementById('adminEmail').value;
    
    var f = new FormData();
    f.append('psw', password);
    f.append('em', email);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            if (request.responseText == 'success') {
                window.location = 'admin/adminDashBoard.php';
            } else {
                document.getElementById('err').innerHTML = request.responseText;
                document.getElementById('msg').className = "d-block";
                document.getElementById('msg').className = "bg-danger p-1 mb-3";
            }
        }
    };
    request.open('POST', 'adminSignInProccess.php', true);
    request.send(f);

}

function editUserProfile() {

    var fname       = document.getElementById('fname');
    var lname       = document.getElementById('lname');
    var mobile      = document.getElementById('mobile');

    var form = new FormData();
    form.append('fname', fname.value);
    form.append('lname', lname.value);
    form.append('mobile', mobile.value);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            if (request.responseText == 'Success') {
                window.location.reload();
            } else {
                document.getElementById('err').innerHTML = request.responseText;
                document.getElementById('msg').className = "d-block";
                document.getElementById('msg').className = "bg-danger p-1 mb-3";
            }
        }
    };
    request.open('POST', 'editUserProfile.php', true);
    request.send(form);

}

function uploadUserProfile() {
    
    var profile = document.getElementById('pro_pic').files[0];

    var form = new FormData();
    form.append('profile', profile);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            if (request.responseText == 'Success') {
                window.location.reload();
            } else {
                document.getElementById('err').innerHTML = request.responseText;
                document.getElementById('msg').className = "d-block";
                document.getElementById('msg').className = "bg-danger p-1 mb-3";
            }
        }
    };
    request.open('POST', 'uploadUserProfilePicture.php', true);
    request.send(form);

}

function addUserAddress() {
    
    var line_1   = document.getElementById('line-1');
    var line_2   = document.getElementById('line-2');
    var z_code   = document.getElementById('zip-code');
    var city     = document.getElementById('city');
    var district = document.getElementById('district');

    var form = new FormData();
    form.append('l1', line_1.value);
    form.append('l2', line_2.value);
    form.append('z', z_code.value);
    form.append('c', city.value);
    form.append('d', district.value);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            if (request.responseText == 'Success') {
                window.location.reload();
            } else {
                document.getElementById('err').innerHTML = request.responseText;
                document.getElementById('msg').className = "d-block";
                document.getElementById('msg').className = "bg-danger p-1 mb-3";
            }
        }
    };
    request.open('POST', 'addUserAddress.php', true);
    request.send(form);

}

function addFeedBack(id) {
    
    var fb = document.getElementById('fb');

    var form = new FormData();
    form.append('fb', fb.value);
    form.append('pId', id);
    
    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            if (request.responseText == 'Success') {
                window.location.reload();
            } else {
                Swal.fire({
                    icon: "error",
                    background: "#000000",
                    color: "#ffffff",
                    title: "Oops...",
                    text: request.responseText,
                });
            }
        }
    };
    request.open('POST', 'addFeedBack.php', true)
    request.send(form);

}

function coupon() {
    
    var c_code = document.getElementById('c_code');
    var price = document.getElementById('price').innerHTML;

    var form = new FormData();
    form.append('c_code', c_code.value);
    form.append('price', price);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            $Obj = JSON.parse(request.responseText);
            // alert(request.responseText);

            if ($Obj.log == 'log') {
                window.location = 'signIn.php';
            } else if ($Obj.emt == 'emt') {
                Swal.fire({
                    icon: "error",
                    background: "#000000",
                    color: "#ffffff",
                    title: "Oops...",
                    text: 'Please enter promo code.',
                });
            } else if ($Obj.invd == 'invd') {
                Swal.fire({
                    icon: "error",
                    background: "#000000",
                    color: "#ffffff",
                    title: "Oops...",
                    text: 'Invalid promo code.',
                });
            } else if ($Obj.used == 'used') {
                Swal.fire({
                    icon: "error",
                    background: "#000000",
                    color: "#ffffff",
                    title: "Oops...",
                    text: 'You are already used this promo code.You can use only one time.',
                });
            } else if ($Obj.exp == 'exp') {
                
                Swal.fire({
                    icon: "error",
                    background: "#000000",
                    color: "#ffffff",
                    title: "Oops...",
                    text: 'Expired this promo code.',
                });
            } else if ($Obj.msg = 'Success') {
                Swal.fire({
                    icon: "success",
                    background: "#000000",
                    color: "#ffffff",
                    title: "Congradulations...!",
                    text: 'You have Rs ' + $Obj.dis + ' discount.',
                    timer: 1500,
                    showConfirmButton: false,
                });
                document.getElementById('price').innerHTML = $Obj.amount;
                document.getElementById('cBtn').classList = 'd-none';
                document.getElementById('dis_value').innerHTML = $Obj.dis;
                document.getElementById('dis_id').innerHTML = $Obj.id;
            }
            
        }
    };
    request.open('POST', 'coupoCheck.php', true);
    request.send(form);
    
}


function search() {

    var brand = document.getElementById('brand').value;
    if (brand == 0) {
        Swal.fire({
            icon: "error",
            background: "#000000",
            color: "#ffffff",
            title: "Oops...",
            text: "Please select a brand",
        });
    } else {
        var request = new XMLHttpRequest();
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                if (request.responseText =- 'error') {     
                    alert(request.responseText);           
                } else {
                    window.location = 'basicSearch.php?brand=' + brand;
                }
            }
        };
        request.open('GET', 'basicSearch.php?brand=' + brand, true);
        request.send();
    }
}

function promoShow() {
    document.getElementById('pro-box').classList = 'd-block';
}


function advancedSearch() {

    var cat = document.getElementById('cat').value;
    var bran = document.getElementById('bran').value;
    var mod = document.getElementById('mod').value;

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            if (request.responseText == 1) {                
                Swal.fire({
                    icon: "error",
                    background: "#000000",
                    color: "#ffffff",
                    title: "OOps...",
                    text: "Please select a catagary.",
                });
            } else if (request.responseText == 2) {                
                Swal.fire({
                    icon: "error",
                    background: "#000000",
                    color: "#ffffff",
                    title: "OOps...",
                    text: "Please select a brand.",
                });
            } else if (request.responseText == 3) {                
                Swal.fire({
                    icon: "error",
                    background: "#000000",
                    color: "#ffffff",
                    title: "OOps...",
                    text: "Please select a model.d",
                });
            } else {
                window.location = 'advancedSearch.php?cat=' + cat + "&bran=" + bran +  "&mod=" + mod;
            }
        }
    };
    request.open('GET', 'advancedSearch.php?cat=' + cat + "&bran=" + bran +  "&mod=" + mod, true);
    request.send();

}

function shippingAddress() {
    
    var adr = document.getElementById('adr').value;

    var form = new FormData();
    form.append('adr', adr);
    
    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            if (request.responseText == 'Success') {
                window.location.reload();
            } else {
                document.getElementById('err').innerHTML = request.responseText;
                document.getElementById('msg').className = "d-block";
                document.getElementById('msg').className = "bg-danger p-3";
            }
        }
    };
    request.open('POST', 'shippingAddress.php', true);
    request.send(form);
    
}

function addProduct() {    

    var pId = document.getElementById('prod-id').value;
    var qty = document.getElementById('prod-qty').value;
    var pri = document.getElementById('price').value;
    var dis = document.getElementById('dis').value;
    var cat = document.getElementById('cat').value;
    var brn = document.getElementById('brn').value;
    var mod = document.getElementById('mod').value;
    var pClr = document.getElementById('pClr').value;
    var img = document.getElementById('prod_img').files[0];

    var form = new FormData();
    form.append('pId', pId);
    form.append('qty', qty);
    form.append('dis', dis);
    form.append('cat', cat);
    form.append('brn', brn);
    form.append('mod', mod);
    form.append('img', img);
    form.append('pri', pri);
    form.append('pClr', pClr);
    
    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            if (request.responseText == 'Success') {
                Swal.fire({
                    icon: "success",
                    background: "#000000",
                    color: "#ffffff",
                    title: "Success.",
                    showConfirmButton: false,
                    timer: 1500,
                    text: "Product registered.",
                });;
            } else {
                Swal.fire({
                    icon: "error",
                    background: "#000000",
                    color: "#ffffff",
                    title: "OOps...",
                    text: request.responseText,
                });
            }
        }
    };
    request.open('POST', 'addProductProccess.php', true);
    request.send(form);

}

function saveColor() {
    
    var color = document.getElementById('clr').value;
    
    var request = new XMLHttpRequest() 
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            if (request.responseText == 'Success') {
                window.location.reload();
            } else {
                Swal.fire({
                    icon: "error",
                    background: "#000000",
                    color: "#ffffff",
                    title: "OOps...",
                    text: request.responseText,
                });
            }
        }
    };
    request.open('GET', 'saveColor.php?clr=' + color, true);
    request.send();

}

function saveNewCatagary() {
    
    var cat = document.getElementById('newCat').value;

    var request = new XMLHttpRequest() 
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            if (request.responseText == 'Success') {
                window.location.reload();
            } else {
                Swal.fire({
                    icon: "error",
                    background: "#000000",
                    color: "#ffffff",
                    title: "OOps...",
                    text: request.responseText,
                });
            }
        }
    };
    request.open('GET', 'saveCatagary.php?cat=' + cat, true);
    request.send();

}

function saveBrand() {
    
    var newBrn = document.getElementById('newBrn').value;

    var request = new XMLHttpRequest() 
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            if (request.responseText == 'Success') {
                window.location.reload();
            } else {
                Swal.fire({
                    icon: "error",
                    background: "#000000",
                    color: "#ffffff",
                    title: "OOps...",
                    text: request.responseText,
                });
            }
        }
    };
    request.open('GET', 'saveBrand.php?brn=' + newBrn, true);
    request.send();

}

function saveModel() {
    
    var newMod = document.getElementById('newMod').value;
    
    var request = new XMLHttpRequest() 
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            if (request.responseText == 'Success') {
                window.location.reload();
            } else {
                Swal.fire({
                    icon: "error",
                    background: "#000000",
                    color: "#ffffff",
                    title: "OOps...",
                    text: request.responseText,
                });
            }
        }
    };
    request.open('GET', 'saveModel.php?mod=' + newMod, true);
    request.send();

}

function updateProduct() {
    
    var pId = document.getElementById('prod-id').value;
    var qty = document.getElementById('prod-qty').value;
    var pri = document.getElementById('price').value;
    var dis = document.getElementById('dis').value;
    var cat = document.getElementById('cat').value;
    var brn = document.getElementById('brn').value;
    var mod = document.getElementById('mod').value;
    var pClr = document.getElementById('pClr').value;

    var form = new FormData();
    form.append('pId', pId);
    form.append('qty', qty);
    form.append('dis', dis);
    form.append('cat', cat);
    form.append('brn', brn);
    form.append('mod', mod);
    form.append('pClr', pClr);
    form.append('pri', pri);
    
    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            if (request.responseText == 'Success') {
                Swal.fire({
                    icon: "success",
                    background: "#000000",
                    color: "#ffffff",
                    title: "Success.",
                    showConfirmButton: false,
                    timer: 1500,
                    text: "Product registered.",
                });;
            } else {
                Swal.fire({
                    icon: "error",
                    background: "#000000",
                    color: "#ffffff",
                    title: "Oops...",
                    text: request.responseText,
                });
            }
        }
    };
    request.open('POST', 'updateProductProccess.php', true);
    request.send(form);

}

function productListReport() {
    window.open('productReport.php');
}

function usersListReport() {
    window.open('usersListReport.php');
}

function promoCode() {
    
    var promo = document.getElementById('promo').value;
    var dis   = document.getElementById('dis').value;
    var exp   = document.getElementById('exp').value;

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            if (request.responseText == 'Success') {
                window.location.reload();
            } else {
                Swal.fire({
                    icon: "error",
                    background: "#000000",
                    color: "#ffffff",
                    title: "Oops...",
                    text: request.responseText,
                });
            }
        }
    };
    request.open('GET', 'savePromo.php?promo=' + promo + '&dis=' + dis + '&exp=' + exp, true);
    request.send();

}

function sendPromo(id) {
    
    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            if (request.responseText == 'Success') {
                Swal.fire({
                    icon: "success",
                    background: "#000000",
                    color: "#ffffff",
                    title: "Success.",
                    showConfirmButton: false,
                    timer: 1500,
                    text: "Proccess Compleated..",
                });;
            } else {
                Swal.fire({
                    icon: "error",
                    background: "#000000",
                    color: "#ffffff",
                    title: "Oops...",
                    text: request.responseText,
                });
            }
        }
    };
    request.open('GET', 'sendPromo.php?id=' + id, true);
    request.send();

}

function outOfStockReport() {
    window.open('outOfStockReport.php');
}
