
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
                    <button class="btn btn-success">Экспорт пдф</button>
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

      }
    },
    components: {
        paginate: Paginate,
    },
    methods:{

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
