<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="{{ asset('customer-assets/js/jQuery-3.5.1.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
</script>
<script src="{{ asset('customer-assets/js/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('customer-assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('customer-assets/plugins/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('customer-assets/js/main.js') }}"></script>

<script>
    var typingTimer;

    $('#search').on('keyup', function() {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(search, 700);
    });

    $('#search').on('keydown', function() {
        clearTimeout(typingTimer);
    });

    function search() {

        let search = $("#search").val();
        $.ajax({
            type: "get",
            url: "{{ route('customer.ajax.search') }}?search=" + search,
            success: function(response) {

                $("#search-result").empty();

                if (response.length >= 1) {
                    response.forEach(item => {

                        $(`<a class="search-result-title d-block" style="text-decoration: none !important" href="${item["url"]}">نتایج جستجو برای 
                        <span class="search-words">${item["name"]}</span>
                        <span class="search-result-type">${item["category"]["name"]}</span>
                        </a>`).appendTo("#search-result");

                    });
                } else {
                    $(`<section class="search-result-item"><span class="search-no-result">موردی یافت نشد</span>`)
                        .appendTo("#search-result");
                }
            }
        });

    }
</script>
