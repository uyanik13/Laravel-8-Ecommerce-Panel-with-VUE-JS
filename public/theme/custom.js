const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content')




function main_live_search() {
    const element = document.getElementById('search_result')
    if (document.getElementById('search_text_input').value == '') {
        element.style.display = 'none'
    } else {
        element.style.display = 'block'
        element.innerHTML = ''
        element.innerText = 'Loading...'
        $.ajax({
            url: '/search/product',
            method: 'get',
            data: { 'search_text': document.getElementById('search_text_input').value },
            success(resp) {
                var element = document.getElementById('search_result')
                element.innerHTML = ''
                var element = document.getElementById('search_result')
                if (resp[1].length < 1) {
                    var new_result = '<li ><h5 class="text-danger text-center search_result_a" style="height: 35px" >Product not found</h5></li>'
                    element.innerHTML += new_result
                }
                for (let i = 0; i < resp[1].length; i++) {
                    var new_result = `<li class="search_result_li"  > <a class="search_result_a" href=/product/${  resp[1][i].slug  }>${  resp[1][i].title  }</li><hr>`
                    element.innerHTML += new_result
                }
            }
        })
    }
}

function sortByKey(key) {
    const lawyerShortSelected = document.getElementById('filter_product_name').selectedIndex
    const lawyerShortOptions = document.getElementById('filter_product_name').options
    const selectedText = lawyerShortOptions[lawyerShortSelected].value
        //console.log()
    const myNode = document.getElementById('filter_drop')

    myNode.innerHTML = ''
    $('#filter_drop').html('<div class="loader-circle" style="margin-left:300px; margin-top:150px"><div class="loader"><div class="loader-dot"></div></div></div>')
    $.ajax({
        url: '/search/filter_product',
        method: 'POST',
        data: { _token: CSRF_TOKEN, selectedText }
    }).done(function(response) {
        const myNode = document.getElementById('filter_drop')
        myNode.innerHTML = ''
        $('#filter_drop').html(response)
            // put the returning html in the 'results' div
    })

}


function live_post_search() {
    const element = document.getElementById('search_result_post')

    if (document.getElementById('search_input_post').value == '') {
        element.style.display = 'none'
    } else {
        element.style.display = 'block'
        element.innerHTML = ''
        element.innerText = 'Loading...'
        $.ajax({

            url: '/search/post',
            method: 'get',
            data: { 'search_text': document.getElementById('search_input_post').value },
            success(resp) {
                var element = document.getElementById('search_result_post')
                element.innerHTML = ''
                var element = document.getElementById('search_result_post')
                if (resp[1].length < 1) {
                    var new_result = '<li ><h5 class="text-danger text-center search_result_a" style="height: 35px" >Product not found</h5></li>'
                    element.innerHTML += new_result
                }
                for (let i = 0; i < resp[1].length; i++) {
                    var new_result = `<li class="search_result_li"  > <a class="search_result_a" href=${  resp[1][i].slug  }>${  resp[1][i].title.substring(0, 18)  }...</a></li><hr>`
                    element.innerHTML += new_result
                }
            }
        })
    }
}

function live_user_search() {
    const element = document.getElementById('search_result_user')

    if (document.getElementById('search_input_user').value == '') {
        element.style.display = 'none'
    } else {
        element.style.display = 'block'
        element.innerHTML = ''
        element.innerText = 'Loading...'
        $.ajax({
            url: '/search/user',
            method: 'get',
            data: { 'search_text': document.getElementById('search_input_user').value },
            success(resp) {
                var element = document.getElementById('search_result_user')
                element.innerHTML = ''
                var element = document.getElementById('search_result_user')
                if (resp[1].length < 1) {
                    var new_result = '<li ><h5 class="text-danger text-center search_result_a" style="height: 35px" >Partner not found</h5></li>'
                    element.innerHTML += new_result
                }
                for (let i = 0; i < resp[1].length; i++) {
                    var new_result = `<li class="search_result_li"  > <a class="search_result_a" href="/partner-details/${  resp[1][i].name  }"><img style="height: 35px" src=${  resp[1][i].avatar  } >${  resp[1][i].name.substring(0, 18)  }...</a></li><hr>`
                    element.innerHTML += new_result
                }
            }
        })
    }
}


function render_basket(is_logged_in) {
    $.ajax({
        url: '/basket/render',
        method: 'POST',
        data: { _token: CSRF_TOKEN, is_logged_in }
    }).done(function(response) {
        const myNode = document.getElementById('cart_parent')
        myNode.innerHTML = ''
        $('#cart_parent').html(response)
    })
}

function add_to_basket(product_id, qty) {
    $.ajax({
        url: '/basket/add_new',
        method: 'get',
        data: { _token: CSRF_TOKEN, product_id, qty }
    }).done(function(response) {
        if (response.success) {
            const element = document.getElementById('success_wishlist')
            element.style.display = 'block'
            element.innerText = 'Added Shopping Card Successfly'
            element.style.color = 'green'
            setTimeout(function() { document.getElementById('success_wishlist').style.display = 'none' }, 2000)
        }
        render_basket()
        const myNode = document.getElementById('cart_parent')
        Swal.fire(
            'Success',
            'Product Added to Cart!',
            'success',
            'Ok'
        )

        myNode.innerHTML = ''
        $('#cart_parent').html(response)
    })
}

function remove_from_basket(product_id, is_from_page = 0) {
    $.ajax({
        url: '/basket/delete',
        method: 'POST',
        data: { _token: CSRF_TOKEN, product_id, is_from_page }
    }).done(function(response) {
        if (is_from_page == 1) {
            render_basket()
            document.getElementById(`card_page_products${product_id}`).remove()
            const span_value = document.getElementById('checkout_sub_total').innerText
            let sub_total = parseInt(span_value.substring(1, span_value.length - 3))
            if (typeof JSON.parse(response.post.product_options).discounted_price === 'undefined') {
                sub_total -= JSON.parse(response.post.product_options).price * response.quantity
            } else {
                sub_total -= JSON.parse(response.post.product_options).discounted_price * response.quantity
            }
            document.getElementById('checkout_sub_total').innerText = `$${sub_total}.00`
            document.getElementById('checkout_last_total').innerText = `$${sub_total}.00`

        } else if (is_from_page == -1) {
            const myNode = document.getElementById('cart_parent')
            myNode.innerHTML = ''
            console.log(response)
            $('#cart_parent').html(response)
            render_basket(0)
        } else {
            const myNode = document.getElementById('cart_parent')
            myNode.innerHTML = ''
            console.log(response)
            $('#cart_parent').html(response)
            render_basket()
        }
    })
}

function quantity_change(post_id, is_inc, input) {
    new_value = input.value
    $.ajax({
        url: '/wish/update',
        method: 'POST',
        data: { _token: CSRF_TOKEN, product_id: post_id, quantity: new_value, is_inc }
    }).done(function(response) {
        let total
        console.log(response)
        if (response.data.post.discounted_price) {
            total = response.data.post.discounted_price * response.data.quantity
        } else {
            total = response.data.post.price * response.data.quantity
        }
        document.getElementById(`subtotal_span${response.data.id}`).innerText = `$${total}`
    })
}

function checkout_quantity_update(product_id, quantity, currency) {
    $.ajax({
        url: '/checkout/update',
        method: 'POST',
        data: { _token: CSRF_TOKEN, product_id, quantity }
    }).done(function(response) {
        render_basket()
        const target = `checkout_subtotal${product_id}`
        const sub_total_target = 'checkout_sub_total'
        const total_target = 'checkout_last_total'
        let total

        console.log(response)
        if (response.product.post.discounted_price) {
            total = response.product.post.discounted_price * response.product.quantity
        } else {
            total = response.product.post.price * response.product.quantity
        }

        document.getElementById(target).innerText = `${response.currency  } ${ total}`
        document.getElementById(sub_total_target).innerText = `${response.currency  } ${ response.cartTotal}`
        document.getElementById(total_target).innerText = `${response.currency  } ${ response.cartTotal}`
    })
}

function remove_wish(div, post_id) {
    $.ajax({
        url: '/wish/delete',
        method: 'POST',
        data: { _token: CSRF_TOKEN, product_id: post_id }
    }).done(function() {
        document.getElementById(`column_wish${post_id}`).style.display = 'none'
    })

}

function add_to_wishlist(product_id, ) {
    $.ajax({
        url: '/wish/add',
        method: 'POST',
        data: { _token: CSRF_TOKEN, product_id }
    }).done(function(response) {
        document.getElementById('success_wishlist').style.display = 'block'
        setTimeout(function() { document.getElementById('success_wishlist').style.display = 'none' }, 2000)
    })
}

function setCookie(name, value, days) {
    let expires = ''
    if (days) {
        const date = new Date()
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000))
        expires = `; expires=${  date.toUTCString()}`
    }
    document.cookie = `${name  }=${  value || ''   }${expires  }; path=/`
}

function getCookie(name) {
    const nameEQ = `${name  }=`
    const ca = document.cookie.split(';')
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i]
        while (c.charAt(0) == ' ') c = c.substring(1, c.length)
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length)
    }
    return null
}

function removeCookie(name) {
    document.cookie = `${name }=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;`
}

function user_login() {
    const email = document.getElementById('email_login').value
    const password = document.getElementById('password_login').value
    Swal.showLoading()
    $.ajax({
        url: '/api/login',
        method: 'POST',
        data: { _token: CSRF_TOKEN, email, password },
        error(error) {
            Swal.hideLoading()
            console.log('error')
        },
        success(response) {
            console.log(response)
            setCookie('token', response.access_token, (response.expires_in / 24))
            Swal.fire({
                title: 'Successfully Logged',
                confirmButtonText: 'Ok'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = '/my-account'
                }
            })
        }
    })
}

function user_register(is_from_guest = 0) {

    if (is_from_guest) {
        const email = document.getElementById('guest_email').value
        const password = document.getElementById('guest_password').value
        const password_confirm = document.getElementById('guest_password_confirm').value
        const name = document.getElementById('guest_name').value
        const accept_terms = document.getElementById('guest_accept_terms').checked
        const addressLine1 = document.getElementById('guest_address_line1').value
        const addressLine2 = document.getElementById('guest_address_line2').value
        const city = document.getElementById('guest_city').value
        const state = document.getElementById('guest_state').value
        const phone = document.getElementById('guest_phone').value
        const country = document.getElementById('guest_country').value
        const post_code = document.getElementById('guest_post_code').value
        if (password_confirm == password) {
            if (!accept_terms) {
                {
                    $.ajax({
                        url: '/api/create_session',
                        method: 'POST',
                        data: {
                            is_from_guest,
                            _token: CSRF_TOKEN,
                            email,
                            password,
                            password_confirmation: password_confirm,
                            name,
                            bill_address: {
                                addressLine1,
                                addressLine2,
                                state,
                                phone,
                                country,
                                post_code
                            },
                            accept_terms

                        }
                    }).done(function(response) {
                        /*
                                                   location.href = '/cart';*/
                    })
                }
            }
        } else {
            alert('passwords should be the same')
        }
    } else {
        const email = document.getElementById('email').value
        const password = document.getElementById('password').value
        const password_confirm = document.getElementById('confirm_password').value
        const first_name = document.getElementById('first_name').value
        const last_name = document.getElementById('last_name').value
        const accept_terms = document.getElementById('accept_terms').value
        const name = first_name + last_name
        $.ajax({
            url: '/api/register',
            method: 'POST',
            data: {
                _token: CSRF_TOKEN,
                email,
                password,
                password_confirmation: password_confirm,
                name,
                accept_terms

            }
        }).done(function(response) {
            //Cookies.set('token', response.data.access_token)
            alert(response.test)
        })
    }
}


function set_localstorage(product_id) {

    const storedNames = JSON.parse(localStorage.getItem('names'))
    if (storedNames) {
        names[0] = prompt(product_id)
        localStorage.setItem('names', JSON.stringify(names))
    } else {

    }
}


function logout() {
    Swal.showLoading()
    $.ajax({
        url: '/api/ajax-logout',
        method: 'POST',
        data: { _token: CSRF_TOKEN },
        error(error) {
            Swal.hideLoading()
            console.log('error')
        },
        success(response) {
            console.log(response)
            removeCookie('token')
            Swal.fire({
                title: 'Successfully Logouted',
                confirmButtonText: 'Ok'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = '/login-register'
                }
            })
        }
    })
}


function ajax_payment() {
    console.log(document.getElementById('card_number'))
    const card_number = document.getElementById('card_number').value
    const exp_month = document.getElementById('exp_month').value
    const exp_year = document.getElementById('exp_year').value
    const cvc = document.getElementById('cvc').value
    const order_id = document.getElementById('order_id').value

    Swal.showLoading()

    $.ajax({
        url: '/ajax/payment',
        method: 'POST',
        data: {
            _token: CSRF_TOKEN,
            card_number,
            exp_month,
            exp_year,
            cvc,
            order_id
        },
        error(error) {
            Swal.hideLoading()
            console.log('error')
        },
        success(response) {
            console.log(response)
            if (response === 'succeeded') {
                Swal.fire('Payment Successfull')
                window.location = '/my-account'
            }
        }
    })
}

function setLocale(language) {
    $.ajax({
        url: '/lang/setLocale',
        method: 'POST',
        data: { _token: CSRF_TOKEN, language }
    }).done(function(response) {
        location.reload()
            //console.log(response)
    })

}


function test() {
    Swal.showLoading()
    Swal.hideLoading()
}

var openmodal = document.querySelectorAll('.modal-open')
for (var i = 0; i < openmodal.length; i++) {
    openmodal[i].addEventListener('click', function(event) {
        event.preventDefault()
        toggleModal()
    })
}

const overlay = document.querySelector('.modal-overlay')
overlay.addEventListener('click', toggleModal)

var closemodal = document.querySelectorAll('.modal-close')
for (var i = 0; i < closemodal.length; i++) {
    closemodal[i].addEventListener('click', toggleModal)
}

document.onkeydown = function(evt) {
    evt = evt || window.event
    var isEscape = false
    if ("key" in evt) {
        isEscape = (evt.key === "Escape" || evt.key === "Esc")
    } else {
        isEscape = (evt.keyCode === 27)
    }
    if (isEscape && document.body.classList.contains('modal-active')) {
        toggleModal()
    }
};


function toggleModal() {
    const body = document.querySelector('body')
    const modal = document.querySelector('.modal')
    modal.classList.toggle('opacity-0')
    modal.classList.toggle('pointer-events-none')
    body.classList.toggle('modal-active')
}

document.getElementById("one").onclick = function() { showTab(this) };
document.getElementById("two").onclick = function() { showTab(this) };


function showTab(e) {
    let selectType = $(e).attr("data-select");
    if (selectType == 'one') {
        $("#tabs2").hide();
        $("#tabs1").show();
        $("#one").addClass('text-blue-800 active');
        $("#two").removeClass('text-blue-800 active');

    } else if (selectType == 'two') {

        $("#tabs1").hide();
        $("#tabs2").show();
        $("#tabs2").removeClass('d-none');
        $("#two").addClass('text-blue-800 active d-block');
        $("#one").removeClass('text-blue-800 active').addClass('text-blue-400');

    }
}