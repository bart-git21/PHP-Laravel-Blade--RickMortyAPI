@extends('layouts.html')

@section('content')
    <h2>Registration</h2>
    <form id="registrationForm">
        @csrf
        <div>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" required autofocus>
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div>
            <label for="password_confirmation">Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required>
        </div>
        <button type="submit">Registration</button>
    </form>
    <script>
        $(document).ready(function () {
            $("#registrationForm").on("submit", function (event) {
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
                        window.location = '/';
                    })
                    .fail((xhr, status, error) => {
                        console.error(xhr.responseText);
                    })
            })
        })
    </script>
@endsection