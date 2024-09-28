@if (session('error'))
    <script>
        swal({
            title: '{{ session("error") }}',
            text: "برای ادامه ( فهمیدم را کلیک کنید )",
            icon: "error",
            button: "فهمیدم",
        });
    </script>
@endif
