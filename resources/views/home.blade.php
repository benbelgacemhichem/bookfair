<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-v4-rtl/4.6.2-1/css/bootstrap-rtl.min.css" integrity="sha512-WxHTBJz83yMvF4RaULb859Uc22mU124Dl8p8UfQVme5On35uLQm7YKwrK30dyf4HqCkrZEfmcqEod34DrWzD9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href= 
        "https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Books</title>
    <style>
        @font-face {
            font-family: myFirstFont;
            src: url('{{ asset('fonts/font.ttf') }}');
        }

        body {
            background: #fcf7eb;
            animation: gradient 15s ease infinite;
            height: 100vh;
            font-family: myFirstFont;
        }

        .card {
            flex-direction: row;
            padding: 10px;
            flex: 1 0 100%;
        }

        .book-img {
            border-radius: 3px;
            transition: transform 1s;
            box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;
        }

        /* .btn {
            background: #0e1a24;
            border: #0e1a24;
        } */

        .book-img:hover {
            transform: scale(1.05);
        }

        .btm img {
            position: fixed;
            overflow-y: scroll;
            overflow-x: hidden;
            bottom: 20px;
            width: 50%;
        }

        #visitor_form .form-control {
            height: 60px;
        }

        input[type="text"] {
            font-size: 24px;
        }
    </style>
</head>

<body>
    @include('sweetalert::alert')
    <div class="btm d-flex justify-content-center">
        <img src="elements2.png" alt="">
    </div>
    <div class="container-fluid pt-3">
        <div class="header mb-3 mt-5 d-flex justify-content-center">
            <div class="logo ">
                <img  src="logo_color.png" style="height: 250px" alt="">
            </div>
        </div>

        <section class="mt-5">
            <div class="d-flex justify-content-center">
                <img class="d-flex justify-content-center" style="height: 30px" src="sp.png"  alt="">
            </div>
            <div class="" style="text-align: center; font-size:3rem;">اطبع كتابك</div>
            <div class="d-flex justify-content-center mb-5">
                <img class="d-flex justify-content-center" style="height: 30px" src="sp.png"  alt="">
            </div>
        </section>
        <section class="highlights">
            <div class="row w-100 m-0 justify-content-center">
                @foreach ($books as $book)
                    <div class="col-lg-2 col-md-4 col-12 mb-4">
                        <div class="card w-100 p-3">
                            <div class="row">
                                <div class="col-md-5">
                                    <img class="card-img-top book-img h-100 w-100" src="{{ $book->image }}"
                                        alt="Card image cap">
                                </div>
                                <div class="col-md-7">
                                    <h3 class="card- mt-4"><strong>{{ $book->name }}</strong></h3>
                                    <h5 class="card-title text-muted">{{ $book->author }}</h5>
                                    <p class="card-text">{{ $book->description }}</p>
                                    <a href="#" style="background: #a97c50; border: #a97c50" class="btn btn-primary stretched-link" data-toggle="modal"
                                        data-target="#formModal" onclick="selectBook({{ $book }})">اطبع الكتاب</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- Modal --}}
        <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><strong> Book </strong></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="visitor_form" method="post" action="{{ route('book.submit') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <h5 class="text-center text-dark"><strong>الرجاء ادخال المعلومات لاستكمال الطلب</strong></h5>
                                </div>
                            </div>
                            <input type="hidden" id="book-id-input" name="book_id">
                            <div class="row mb-3">
                                <div class="col-md-3"><label>الاسم الكامل<small class="text-danger">*</small></label></div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3"><label>البريد الالكتروني<small class="text-danger">*</small></label></div>
                                <div class="col-md-9">
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3"><label>رقم الجوال<small class="text-danger">*</small></label></div>
                                <div class="col-md-9">
                                    <input type="number" class="form-control" name="phone" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">الغاء</button>
                            <button type="button" class="btn btn-primary btn-lg" id="submit-btn">طلب</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        function selectBook(book) {
            document.getElementById('book-id-input').value = book.id;
            let modalTitle = document.querySelector('.modal-title');
            modalTitle.innerHTML = `<strong> ${book.name} </strong>`
        }

        $('#submit-btn').click(function(e) {
            e.preventDefault();
            let form = $('#visitor_form')[0];
            let data = new FormData(form);
            $.ajax({
                url: "{{ route('book.submit') }}",
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
                        $('#formModal').modal('hide')
                    }
                }
            })
        })
    </script>
</body>

</html>
