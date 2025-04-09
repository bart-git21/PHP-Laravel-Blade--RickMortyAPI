<form>
    <div class="mb-3 form-check d-flex justify-content-center">
        <button id="{{ $buttonId }}" type="submit" class="btn btn-primary">{{$buttonText}}</button>
    </div>
</form>

<script>
    $(document).ready(function () {
        $("#{{ $buttonId }}").on('click', function (event) {
            event.preventDefault();
            $("#{{ $buttonId }}").text("Данные загружаются...").prop('disabled', true);
            $.ajax({ url: '/rickmortyapi' })
                .done((response) => {
                    const jobId = response.jobId;
                    const polling = setInterval(() => {
                        $.ajax({ url: `/jobstatus/${jobId}`, })
                            .done((response) => {
                                console.log(response);
                                if (response.status === 'completed') {
                                    clearInterval(polling);
                                    window.location.href = `/`;
                                }
                            })
                            .fail(() => { })
                    }, 3000)
                })
                .fail(() => { })
        })
    });
</script>