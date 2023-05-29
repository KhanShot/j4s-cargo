
<template>
</template>
<script >
export default {
    data() {
        return {
            barcode: '',
            interval: null,
        }
    },
    mounted() {
        window.addEventListener('keydown', this.trigger )
    },
    watch:{
    },

    methods:{
        trigger(event){
            if(this.interval)
                clearInterval(this.interval)
            if(event.code == "Enter"){
                if(this.barcode)
                    this.handleBarCode(this.barcode);
                this.barcode = '';
                return;
            }
            if(event.key != "Shift")
                this.barcode += event.key;
            this.interval = setInterval(() => this.barcode = '', 20)
        },

        handleBarCode(scanned_code){

            axios
                .post('/admin/tracks/scan', {'scanned_code': scanned_code})
                .then((response) => {
                    if (response.data.success) {
                        let Toast = Swal.mixin({
                            // toast: true,
                            position: 'center',
                            showConfirmButton: true,
                            timer: 3000,
                            timerProgressBar: true,
                        })
                        Toast.fire({
                            icon: 'success',
                            title: response.data.message
                        })
                    }
                }).catch((error) => {
                console.log(error)
                let Toast = Swal.mixin({
                    // toast: true,
                    position: 'center',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                })
                Toast.fire({
                    icon: 'error',
                    title: error.response.data.message
                })
            })
        }
    }
}
</script>
