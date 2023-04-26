<template>
    <div class="mt-4 p-3 bg-light rounded border border-1">
        <h2>Filtre</h2>
        <!-- Jobdomain -->
        <div class="d-flex flex-row">
            <div class="mx-2">
                <b-form-floating-label>Domaine d'activité</b-form-floating-label>
                <b-form-select v-model="filters.jobdomain" @input="fetch()">
                    <option value="null" selected></option>
                    <option
                        v-for="jobdomain in filtersOptions.jobdomain"
                        :key="jobdomain.id"
                        :value="jobdomain.id"
                    >{{ jobdomain.label }}
                    </option>
                </b-form-select>
            </div>
            <!-- Job -->
            <div class="mx-2">
                <b-form-floating-label>Métier</b-form-floating-label>
                <b-form-select v-model="filters.job" @input="fetch()" :disabled="filters.jobdomain === null || filters.jobdomain === undefined || filters.jobdomain === 'null'">
                    <option value="null" selected></option>
                    <option
                        v-for="job in jobs"
                        :key="job.id"
                        :value="job.id"
                    >{{ job.label }}
                    </option>
                </b-form-select>
            </div>
            <!-- Contract type -->
            <div class="mx-2">
                <b-form-floating-label>Type de contrat</b-form-floating-label>
                <b-form-select v-model="filters.contractType" @input="fetch()">
                    <option value="null" selected></option>
                    <option
                        v-for="contractType in filtersOptions.contractType"
                        :key="contractType.id"
                        :value="contractType.id"
                    >{{ contractType.labelLong }}
                    </option>
                </b-form-select>
            </div>
            <div>
                <b-button class="mt-4" variant="danger" @click="resetFilters">Réinitialiser</b-button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "DashboardFilter",
    props: {
        filters: {
            type: Object,
            required: true
        },
        filtersOptions: {
            type: Object,
            required: true
        },
    },

    data() {
        return {
            jobs: [],
        }
    },
    mounted() {
        this.fetch();
    },
    methods: {
        fetch() {
            this.jobs = this.filteredJobs();
            this.$emit('update:filters', this.filters);
        },
        filteredJobs() {
            return this.filtersOptions.job.filter((job) => {
                let include = false;

                job.jobDomains && job.jobDomains.forEach((jobDomain) => {
                    if (!include && Number(jobDomain.split('/api/job_domains/')[1]) === this.filters.jobdomain) {
                        include = true;
                    }
                });

                return include;
            });
        },
        resetFilters() {
            this.filters.jobdomain = null;
            this.filters.job = null;
            this.filters.contractType = null;
            this.fetch();
        }
    }
}
</script>

<style scoped>

</style>
