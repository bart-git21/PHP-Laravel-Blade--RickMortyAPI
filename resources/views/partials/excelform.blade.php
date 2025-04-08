<form id="excelForm" class="mb-3" action="" method="">
    <button id="exportBtn" type="submit" class="btn btn-outline-success">
        <img src="{{ asset('images/icons8-excel-48.png') }}" alt="">Export to Excel
    </button>

    <script>
        $(document).ready(function () {
            $('#exportBtn').on('click', function (event) {
                event.preventDefault();
                const characters = @json($characters);
                $.ajax({
                    url: '/export',
                    method: "POST",
                    data: JSON.stringify({ table: characters }),
                    contentType: 'application/json',
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                })
                    .done(response => {
                        const link = document.createElement('a');
                        link.href = 'data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,' + response.fileData;
                        link.download = 'filtered_characters.xlsx';
                        link.textContent = 'download';
                        $("#excelForm").append(link);
                    })
                    .fail()
            })
        })
    </script>
</form>