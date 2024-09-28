<script>
    function destroy(id) {
        this.preventDefault;
        swal({
                title: "توجه !",
                text: "آیا میخواهید این آیتم را حذف کنید ؟",
                icon: "warning",
                buttons: ["پشیمون شدم !", "آره"],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    Livewire.emit("destroy", id);
                    swal({
                        title: 'آیتم با موفقیت حذف شد',
                        text: "برای ادامه ( حله را کلیک کنید )",
                        icon: "success",
                        button: "حله",
                    });
                } else {
                    swal({
                        text: "آیتم شما همچنان امن است",
                        button: "حله"
                    });
                    return false;
                }
            });
    }
</script>
