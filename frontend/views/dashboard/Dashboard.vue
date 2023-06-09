<template>
    <div>

        <h1>Accueil</h1>
        <DashboardFilter :filters-options="filtersOptions" :filters="filters" @update:filters="reload()"/>
        <div class="bg-light rounded border border-1 p-3 mt-4">
            <b-pagination
                v-model="currentPage"
                :total-rows="pagination.total"
                :per-page="pagination.itemsPerPage"
            ></b-pagination>
            <div class="d-flex flex-wrap justify-content-start my-4 p-3 rounded border border-1">
                <item
                    :item="object"
                    v-for="object in objects"
                    :key="object.id"
                    class="m-1"
                ></item>
            </div>
            <b-pagination
                v-model="currentPage"
                :total-rows="pagination.total"
                :per-page="pagination.itemsPerPage"
            ></b-pagination>
        </div>
    </div>
</template>

<script>
import Item from "../casting-offers/Item.vue";
import Pagination from "../../components/dataHandler/Pagination.vue";
import DashboardFilter from "./DashboardFilter.vue";

export default {
    name: "Dashboard",
    components: {
        DashboardFilter,
        Pagination,
        Item
    },
    data() {
        return {
            objects: [],
            filters: {
                jobdomain: null,
                job: null,
                contractType: null,
            },

            filtersOptions: {
                jobdomain: [],
                job: [],
                contractType: [],
            },

            pagination: {
                page: 1,
                perPage: 30,
                total: 0,
                pages: 2,
            }
        }
    },
    computed: {
        rows() {
            return this.pagination.pages;
        },
        perPage() {
            return this.pagination.perPage;
        },
        currentPage: {
            get() {
                return this.pagination.page;
            },
            set(value) {
                this.pagination.page = value;
                this.reload();
            }
        }
    },
    mounted() {
        this.$store
            .dispatch('job_domains_store/fetchItems', {page: 1, itemsPerPage: 1000})
            .then((response) => {
                this.filtersOptions.jobdomain = response;
            });

        this.$store
            .dispatch('jobs_store/fetchItems', {page: 1, itemsPerPage: 1000})
            .then((response) => {
                this.filtersOptions.job = response;
            });

        this.$store
            .dispatch('contract_types_store/fetchItems', {page: 1, itemsPerPage: 1000})
            .then((response) => {
                this.filtersOptions.contractType = response;
            });
    },
    methods: {
        reload() {
            this.$store
                .dispatch('casting_offers_store/index', { ...this.filters, page: this.pagination.page, itemsPerPage: this.pagination.perPage })
                .then((response) => {
                    this.objects = response.data;
                    this.pagination.total = response.pagination.total;
                    this.pagination.pages = response.pagination.pages;
                });
        }
    }
}
</script>

<style scoped>
</style>
