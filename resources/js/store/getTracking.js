import {defineStore} from "pinia";

export const useGetTracking = defineStore('trackingStore', {
    state: () => ({
        logs: [],
        pagination: [],
    }),
    actions: {
        async SCAN_BARCODE(scanned_code){
            axios
                .post('/admin/tracks/scan', {'scanned_code': scanned_code})
                .then( (response) => {

                    if (response.data.success) {
                        let Toast = Swal.mixin({
                            // toast: true,
                            position: 'center',
                            showConfirmButton: true,
                            allowEscapeKey: false,
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
                    allowEscapeKey: false,
                    timer: 3000,
                    timerProgressBar: true,
                })
                Toast.fire({
                    icon: 'error',
                    title: error.response.data.message
                })
            })
            await this.GET_LOGS();
        },
        async GET_LOGS(page = 1){
            return await axios
                .get('/get-logs?page=' + page)
                .then((response) => {
                    this.logs = response.data.data
                    this.pagination = response.data.pagination
                }).catch((error) => {
                    console.log(error)
                })
        }
    }
});
