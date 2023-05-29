
<template>
</template>
<script >
import {useGetTracking} from "../store/getTracking";

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
            useGetTracking().SCAN_BARCODE(scanned_code)
        }
    }
}
</script>
