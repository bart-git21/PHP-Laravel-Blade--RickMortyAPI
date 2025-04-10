@extends('layouts.html')

@section('content')
    <h2>Log in</h2>
    <form id="loginForm" action="" method="POST">
        @csrf
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required autofocus>
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </div>
        <button type="submit">Log in</button>
    </form>
    <script>
        $(document).ready(function () {
            $("#loginForm").on("submit", function (event) {
                event.preventDefault();
                $.ajax({
                    url: "",
                    method: "POST",
                    data: $(this).serialize(),
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    }
                })
                    .done((response) => {
                        window.location.href = "/";
                    })
                    .fail((xhr, status, error) => {
                        console.error(xhr.responseText);
                    })
            })
        })
    </script>
@endsection