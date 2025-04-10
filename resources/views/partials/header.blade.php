<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img class="logo" src="{{ asset('images/logo.png') }}" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/protected">protected</a>
                    </li>
                </ul>

                @if (Auth::check())
                    <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-success">log out {{ auth()->user()->name }}</button>
                    </form>
                @else
                    <a href="{{ route('login') }}"> <button class="btn btn-outline-success me-2">log in</button></a>
                    <a href="{{ route('register') }}"><button class="btn btn-outline-success">registration</button></a>
                @endif
            </div>
        </div>
    </nav>
</header>

<script>
    $("#logoutForm").on('click', function () {
        if (confirm("Are you sure you want to log out?")) {
            $.ajax({
                url: '/logout',
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                }
            })
                .done((response) => {
                    console.log(response);
                })
                .fail((xhr, status, error) => {
                    console.error(xhr.responseText);
                })
                .always(() => {
                    location.reload();
                })
        }
    })
</script>

<style>
    .logo {
        width: 2vw;
    }
</style>