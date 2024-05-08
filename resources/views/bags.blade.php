<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link href=
        "https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Bags</title>
    <style>
        @font-face {
            font-family: myFirstFont;
            src: url('{{ asset('fonts/font.ttf') }}');
        }

        @font-face {
            font-family: myFirstFont2;
            src: url('{{ asset('fonts/QatarFont-Regular.woff') }}');
        }

        body {
            background: #fcf7eb;
            animation: gradient 15s ease infinite;
            height: 100vh;
            font-family: myFirstFont2;
        }

        .book-img {
            margin: .2em;
            border-radius: 3px;
            transition: transform 1s;
            box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;
        }

        .btm img {
            position: fixed;
            overflow-y: scroll;
            overflow-x: hidden;
            bottom: 0px;
            width: 100%;
        }
        .navbar {
            position: fixed;
            top: 30px;
            right: 30px;
        }
    </style>
</head>

<body>
    @include('sweetalert::alert')
    <div class="btm d-flex justify-content-center">
        <img src="{{ asset('elements.png') }}" alt="">
    </div>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg bg-transparent justify-content-end">
            <a class="navbar-brand fw-bold" href="{{ route('bags', 'ar') }}">
                العربية
                <img src="https://cdn-icons-png.flaticon.com/512/6133/6133973.png" alt="" style="width: 40px; height: 35px">
            </a>
        </nav>
        <div class="header mb-2 mt-3 d-flex justify-content-center">
            <div class="logo ">
                <img  src="{{ asset('logo_color.png') }}" style="height: 80px" alt="">
            </div>
        </div>

        <section class="mt-5">
            <div class="d-flex justify-content-center">
                <img class="d-flex justify-content-center" style="height: 30px" src="{{ asset('sp.png') }}"  alt="">
            </div>
            <div class="" style="text-align: center; font-size:2rem;">Print your bag with Qatar font</div>
            <div class="d-flex justify-content-center mb-5">
                <img class="d-flex justify-content-center" style="height: 30px" src="{{ asset('sp.png') }}"  alt="">
            </div>
        </section>

        <section class="highlights">
            <div class="row m-0 justify-content-center">
                <div class="col-lg-2 col-md-4 col-12 mb-4">
                    <a href="" data-toggle="modal" data-target="#bagModal" onclick="selectBag('Bag 1')">
                        <div class="card">
                            <img class="card-img-top book-img" src="{{ asset('b1.png') }}" alt="Card image cap">
                        </div>
                    </a>
                </div>
                <div class="col-lg-2 col-md-4 col-12 mb-4">
                    <a href="" data-toggle="modal" data-target="#bagModal" onclick="selectBag('Bag 2')">
                        <div class="card ">
                            <img class="card-img-top book-img" src="{{ asset('b2.png') }}" alt="Card image cap">
                        </div>
                    </a>
                </div>
            </div>
            <div class="row m-0 justify-content-center">
                <div class="col-lg-2 col-md-4 col-12 mb-4">
                    <a href="" data-toggle="modal" data-target="#bagModal" onclick="selectBag('Bag 3')">
                        <div class="card">
                            <img class="card-img-top book-img" src="{{ asset('b3.png') }}" alt="Card image cap">
                        </div>
                    </a>
                </div>
                <div class="col-lg-2 col-md-4 col-12 mb-4">
                    <a href="" data-toggle="modal" data-target="#bagModal" onclick="selectBag('Bag 4')">
                        <div class="card">
                            <img class="card-img-top book-img" src="{{ asset('b4.png') }}" alt="Card image cap">
                        </div>
                    </a>
                </div>
            </div>
        </section>

        {{-- Modal --}}
        <div class="modal fade" id="bagModal" tabindex="-1" role="dialog" aria-labelledby="bagModalTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><strong> Book </strong></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="visitor_form" method="post" action="{{ route('bags.submit') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <h5 class="text-center text-dark"><strong>Please enter the information to complete the request</strong></h5>
                                </div>
                            </div>
                            <input type="hidden" id="bag-style-input" name="bag_style">
                            <div class="row mb-3">
                                <div class="col-md-3"><label>Full name<small class="text-danger">*</small></label></div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3"><label>Email<small class="text-danger">*</small></label></div>
                                <div class="col-md-9">
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3"><label>Phone number<small class="text-danger">*</small></label></div>
                                <div class="col-md-9">
                                    <input type="number" class="form-control" name="phone" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3"><label>Bag text<small class="text-danger">*</small></label></div>
                                <div class="col-md-9">
                                    <textarea class="form-control" name="bag_content" rows="4" required>

                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary btn-lg" id="submit-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">

        function selectBag(title) {
            document.getElementById('bag-style-input').value = title;
            let modalTitle = document.querySelector('.modal-title');
            modalTitle.innerHTML = `<strong> ${title} </strong>`
        }

        $('#submit-btn').click(function(e) {
            e.preventDefault();
            let form = $('#visitor_form')[0];
            let data = new FormData(form);
            $.ajax({
                url: "{{ route('bags.submit') }}",
                type: "POST",
                data: data,
                dataType: "JSON",
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.errors) {
                        var errorMsg = '';
                        $.each(response.errors, function(field, errors) {
                            $.each(errors, function(index, error) {
                                errorMsg += error + ' ';
                            });
                        });
                        Swal.fire({
                            title: "Something wrong",
                            text: errorMsg,
                            icon: "error",
                        })
                    } else {
                        Swal.fire({
                            title: "Success",
                            text: response.success,
                            icon: "success",
                        });
                        form.reset()
                        $('#bagModal').modal('hide')
                    }
                }
            })
        })
    </script>
</body>

</html>
