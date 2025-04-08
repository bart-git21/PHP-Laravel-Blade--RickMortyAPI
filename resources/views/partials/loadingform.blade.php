<form>
    <div class="mb-3 form-check d-flex justify-content-center">
        <button id="dispatchJobsBtn" type="submit" class="btn btn-primary">Получить данные</button>
    </div>
</form>

<script>
    $(document).ready(function () {
        $("#dispatchJobsBtn").on('click', function (event) {
            event.preventDefault();
            $("#dispatchJobsBtn").text("Данные загружаются...").prop('disabled', true);
            alert("from script");
            $.ajax({ url: '/rickmortyapi' })
                .done((response) => {
                    console.log(response);
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
                    }, 2000)
                })
                .fail(() => { })
        })
    });
</script>