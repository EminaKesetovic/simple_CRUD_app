<template>
    <div class="row">
        <div class="col-12 mb-2 text-end">
            <button class="btn btn-primary" @click="getCountries()">Refresh</button>
            <router-link :to='{name:"countryAdd"}' class="btn btn-primary">Create</router-link>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Country</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group">
                            <input type="search" class="form-control" v-model="filter">
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th v-on:click="sortBy('id')">ID</th>
                                    <th v-on:click="sortBy('name')">Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody v-if="countries.length > 0">
                                <tr v-for="(country,key) in sortedCountries" :key="key">
                                    <td>{{ country.id }}</td>
                                    <td>{{ country.name }}</td>
                                    <td>
                                        <router-link :to='{name:"countryEdit",params:{id:country.id}}' class="btn btn-success">Edit</router-link>
                                        <button type="button" @click="deleteCountry(country.id)" class="btn btn-danger">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                            <tbody v-else>
                                <tr>
                                    <td colspan="4" align="center">No Countries Found.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:"countries",
    data(){
        return {
            currentSort:'id',
            currentSortDir:'asc',
            filter:'',
            countries:[]
        }
    },
    mounted(){
        this.getCountries()
    },
    methods:{
        async getCountries(){
            await this.axios.get('/api/country').then(response=>{
                this.countries = response.data
            }).catch(error=>{
                console.log(error)
                this.countries = []
            })
        },
        sortBy(column) {
            //if column == current sort, reverse
            if(column === this.currentSort) {
            this.currentSortDir = this.currentSortDir === 'asc' ? 'desc' : 'asc';
            }
            this.currentSort = column;
        },
        deleteCountry(id){
            if(confirm("Are you sure to delete this country ?")){
                this.axios.delete(`/api/country/${id}`).then(response=>{
                    this.getCountries()
                }).catch(error=>{
                    console.log(error)
                })
            }
        }
    },
    computed:{
        filteredCountries() {
            return this.countries.filter(c => {
                if(this.filter == '') return true;
                return c.name.toLowerCase().indexOf(this.filter.toLowerCase()) >= 0;
            })
        },
        sortedCountries:function() {
            return this.filteredCountries.sort((a,b) => {
                let modifier = 1;
                if(this.currentSortDir === 'desc') modifier = -1;
                if(a[this.currentSort] < b[this.currentSort]) return -1 * modifier;
                if(a[this.currentSort] > b[this.currentSort]) return 1 * modifier;
                return 0;
            });
        }
    }
}
</script>
