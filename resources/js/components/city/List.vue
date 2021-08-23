<template>
    <div class="row">
        <div class="col-12 mb-2 text-end">
            <button class="btn btn-primary" v-on:click="getCities()">Refresh</button>
            <router-link :to='{name:"cityAdd"}' class="btn btn-success">Create</router-link>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>City</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group">
                            <input type="search" class="form-control" v-model="filter" placeholder="Search cities...">
                        </div>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th v-on:click="sortBy('id')">ID</th>
                                    <th v-on:click="sortBy('name')">Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody v-if="cities.length > 0">
                                <tr v-for="(city,key) in sortedCities" :key="key">
                                    <td>{{ city.id }}</td>
                                    <td>{{ city.name }}</td>
                                    <td>
                                        <router-link :to='{name:"cityEdit",params:{id:city.id}}' class="btn btn-success">Edit</router-link>
                                        <button v-if="city.clients_number == 0" type="button" v-on:click="deleteCity(city.id)" class="btn btn-danger">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                            <tbody v-else>
                                <tr>
                                    <td colspan="4" align="center">No Cities Found.</td>
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
    name:"cities",
    data(){
        return {
            currentSort:'id',
            currentSortDir:'asc',
            filter:'',
            cities:[]
        }
    },
    mounted(){
        this.getCities()
    },
    methods:{
        async getCities(){
            await this.axios.get('/api/city').then(response=>{
                this.cities = response.data
            }).catch(error=>{
                console.log(error)
                this.cities = []
            })
        },
        sortBy(column) {
            //if column == current sort, reverse
            if(column === this.currentSort) {
            this.currentSortDir = this.currentSortDir === 'asc' ? 'desc' : 'asc';
            }
            this.currentSort = column;
        },
        deleteCity(id){
            if(confirm("Are you sure to delete this city ?")){
                this.axios.delete(`/api/city/${id}`).then(response=>{
                    this.getCities()
                }).catch(error=>{
                    console.log(error)
                })
            }
        }
    },
    computed:{
        filteredCities() {
            return this.cities.filter(city => {
                if(this.filter == '') return true;
                return city.name.toLowerCase().indexOf(this.filter.toLowerCase()) >= 0;
            })
        },
        sortedCities:function() {
            return this.filteredCities.sort((a,b) => {
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
