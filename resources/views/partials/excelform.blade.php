<form id="excelForm" class="mb-3 d-flex flex-column" action="" method="">
    <button id="exportAllToExcelBtn" type="submit" class="btn btn-outline-success my-2">
        <img src="{{ asset('images/icons8-excel-48.png') }}" alt="">All data export to Excel
    </button>
    <button id="exportFilteredToExcelBtn" type="submit" class="btn btn-outline-success my-2">
        <img src="{{ asset('images/icons8-excel-48.png') }}" alt="">Filtered data export to Excel
    </button>

    <script>
        $(document).ready(function () {
            const params = {
                name: @json($name ?? ''),
                options: @json($options ?? ''),
                episode: @json($episode ?? ''),
                location: @json($location ?? ''),
            }

            function createExcelDownloadableLink(params, excelLinkTitle) {
                $.ajax({
                    url: '/export',
                    method: "POST",
                    data: JSON.stringify(params),
                    contentType: 'application/json',
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                })
                    .done(response => {
                        const link = document.createElement('a');
                        link.href = 'data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,' + response.fileData;
                        link.download = 'filtered_characters.xlsx';
                        link.textContent = excelLinkTitle;
                        $("#excelForm").append(link);
                    })
                    .fail()
            }
            $('#exportAllToExcelBtn').on('click', function (event) {
                event.preventDefault();
                createExcelDownloadableLink({
                    name: '',
                    options: '',
                    episode: '',
                    location: '',
                }, 'download all');
            })
            $('#exportFilteredToExcelBtn').on('click', function (event) {
                event.preventDefault();
                createExcelDownloadableLink(params, 'download filtered characters')
            })
        })
    </script>
</form>