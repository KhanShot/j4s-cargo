
<template>
    <div class="content-wrapper">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Логи</h3>
        </div>
        <div class="card">
            <div class="card-body d-flex">
                <div class="form-group col-md-2">
                    <label>Трек код</label>
                    <input class="form-control" placeholder="Поиск">
                </div>
                <div class="form-group col-md-2">
                    <label>Дата от</label>
                    <input type="date" class="form-control" placeholder="Поиск">
                </div>
                <div class="form-group col-md-2">
                    <label>Дата до</label>
                    <input type="date" class="form-control" placeholder="Поиск">
                </div>

                <div class="form-group col-md-2 d-flex flex-column">
                    <label class="opacity-0" style="opacity: 0">a</label>
                    <button class="btn btn-info">Фильтр</button>
                </div>
                <div class="form-group col-md-2 d-flex flex-column">
                    <label class="opacity-0" style="opacity: 0">a</label>
                    <button class="btn btn-warning">Сбросить фильтр</button>
                </div>
                <div class="form-group col-md-2 d-flex flex-column">
                    <label class="opacity-0" style="opacity: 0">a</label>
                    <button class="btn btn-success" data-toggle="modal" data-target="#importModal">Импрпорт пдф</button>
                </div>
            </div>
        </div>
        <table class="table mt-4">
            <thead>
            <tr>
                <th>#</th>
                <th>Трек код</th>
                <th>Пользователь</th>
                <th>Город</th>
                <th>Статус</th>
                <th>Текст</th>
                <th>Время сканирование</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="log in logs">
                <td>{{log.id}}</td>
                <td>{{log.scanned_code}}</td>
                <td>{{log.user_name}}</td>
                <td>{{log.city}}</td>
                <td v-html="log.status"></td>
                <td>{{log.text}}</td>
                <td>{{log.created_at}}</td>
            </tr>
            </tbody>
        </table>
        <paginate
            v-model="pagination.current_page"
            :page-count="pagination.last_page"
            :page-range="3"
            :margin-pages="1"
            :click-handler="pageHandler"
            :prev-text="'Пред'"
            :next-text="'След'"
            :container-class="'pagination justify-content-end'"
            :page-class="'page-item'"
        >
        </paginate>


        <!-- Modal -->
        <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="importModalLabel">Импортировать сканы</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                            <div class="form-group">
                                <label>Выберите локацию импорта</label>
                                <select v-model="formData.import_location" class="form-control">
                                    <option value="china">Склад(Китай)</option>
                                    <option value="kaz">Казахстан</option>
                                    <option value="kaz_pvz">ПВЗ Казахстан</option>
                                </select>
                            </div>

                            <div>
                                <label for="file">Выберите файл (эксель)</label>
                                <input type="file" accept=".xlsx, .xls, .csv" class="form-control" @change="handleFileChange" required>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" @click="submitForm" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>
<script >

import {useGetTracking} from "../store/getTracking";
import {storeToRefs} from "pinia";
import {onMounted} from "vue";
import Paginate from 'vuejs-paginate-next';

export default {
    data(){
      return {
          formData: {
              import_location: "",
              file: null,
          },
      }
    },
    components: {
        paginate: Paginate,
    },
    methods:{
        handleFileChange(event) {
            // Update the formData object with the selected file
            this.formData.file = event.target.files[0];
        },
        submitForm() {
            // Create a FormData object to send the data to the server
            const formData = new FormData();
            formData.append('import_location', this.formData.import_location);
            formData.append('file', this.formData.file);

            // You can now make an HTTP POST request to your server to handle the form submission
            // For example, using Axios:
            axios.post('/admin/logs/import', formData)
              .then(response => {
                // Handle the server response
              })
              .catch(error => {
                // Handle errors
              });
        },
    },
    setup(){
        const store = useGetTracking()
        const {GET_LOGS} = store
        const {logs, pagination} = storeToRefs(store)

        const pageHandler = async (pageNum) => {
            console.log('__' + pageNum)
            await GET_LOGS(pageNum);
        }
        onMounted(async () => {
            await GET_LOGS(1);
            new DataTable('#dataTable',{
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/ru.json',
                },
                data: JSON.parse(JSON.stringify(logs.value)),
                "order": []
            })
        })

        return {logs, pagination, pageHandler};

    }
}

</script>
