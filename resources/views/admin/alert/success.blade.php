@if (session('success'))
    <script>
        swal({
            title: '{{ session("success") }}',
            text: "برای ادامه ( حله را کلیک کنید )",
            icon: "success",
            button: "حله",
        });
    </script>
@endif
